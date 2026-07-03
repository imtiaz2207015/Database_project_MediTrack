<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Purchase::with(['supplier', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('supplier', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sortBy  = in_array($request->sort_by, ['purchase_date','total_amount']) ? $request->sort_by : 'purchase_date';
        $sortDir = $request->sort_dir === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortBy, $sortDir);

        $purchases = $query->paginate(15)->withQueryString();
        return view('purchases.index', compact('purchases', 'sortBy', 'sortDir'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $medicines = Medicine::orderBy('name')->get();
        return view('purchases.create', compact('suppliers', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'        => 'required|exists:suppliers,id',
            'purchase_date'      => 'required|date',
            'medicines'          => 'required|array|min:1',
            'medicines.*.id'     => 'required|exists:medicines,id',
            'medicines.*.qty'    => 'required|integer|min:1',
            'medicines.*.price'  => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            $items = [];

            foreach ($request->medicines as $item) {
                $subtotal  = $item['price'] * $item['qty'];
                $total    += $subtotal;
                $items[]   = [
                    'medicine_id' => $item['id'],
                    'quantity'    => $item['qty'],
                    'unit_price'  => $item['price'],
                    'subtotal'    => $subtotal,
                ];

                // Stock is increased automatically by the AFTER_PURCHASE_ITEM_INSERT trigger
            }

            $purchase = Purchase::create([
                'supplier_id'   => $request->supplier_id,
                'user_id'       => Auth::id(),
                'total_amount'  => $total,
                'status'        => $request->status ?? 'received',
                'purchase_date' => $request->purchase_date,
            ]);

            foreach ($items as $item) {
                $item['purchase_id'] = $purchase->id;
                PurchaseItem::create($item);
            }
        });

        return redirect()->route('purchases.index')
                         ->with('success', 'Purchase recorded successfully!');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'user', 'purchaseItems.medicine']);
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $purchase->load('purchaseItems.medicine');
        $suppliers = Supplier::orderBy('name')->get();
        return view('purchases.edit', compact('purchase', 'suppliers'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        // Purchases can only update non-critical fields like status
        $request->validate([
            'status' => 'required|in:pending,received,cancelled',
        ]);

        $purchase->update(['status' => $request->status]);

        return redirect()->route('purchases.show', $purchase)
                         ->with('success', 'Purchase updated successfully!');
    }

    public function destroy(Purchase $purchase)
    {
        DB::transaction(function () use ($purchase) {
            $purchase->purchaseItems()->delete(); // trigger reverses stock automatically
            $purchase->delete();
        });

        return redirect()->route('purchases.index')
                         ->with('success', 'Purchase deleted and stock reversed!');
    }
}