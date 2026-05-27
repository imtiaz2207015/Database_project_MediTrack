<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Medicine;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['customer', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('customer', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $sortBy  = in_array($request->sort_by, ['created_at','total_amount','paid_amount']) ? $request->sort_by : 'created_at';
        $sortDir = $request->sort_dir === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortBy, $sortDir);

        $sales = $query->paginate(15)->withQueryString();
        return view('sales.index', compact('sales', 'sortBy', 'sortDir'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $medicines = Medicine::where('stock_quantity', '>', 0)->orderBy('name')->get();
        return view('sales.create', compact('customers', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicines'          => 'required|array|min:1',
            'medicines.*.id'     => 'required|exists:medicines,id',
            'medicines.*.qty'    => 'required|integer|min:1',
            'payment_method'     => 'required',
            'paid_amount'        => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $total    = 0;
            $items    = [];

            foreach ($request->medicines as $item) {
                $medicine  = Medicine::findOrFail($item['id']);
                $subtotal  = $medicine->price * $item['qty'];
                $total    += $subtotal;
                $items[]   = [
                    'medicine_id' => $medicine->id,
                    'quantity'    => $item['qty'],
                    'unit_price'  => $medicine->price,
                    'subtotal'    => $subtotal,
                ];

                // Reduce stock
                $medicine->decrement('stock_quantity', $item['qty']);
            }

            $discount = $request->discount ?? 0;

            $sale = Sale::create([
                'customer_id'    => $request->customer_id ?? null,
                'user_id'        => Auth::id(),
                'total_amount'   => $total,
                'discount'       => $discount,
                'paid_amount'    => $request->paid_amount,
                'payment_method' => $request->payment_method,
                'status'         => 'completed',
            ]);

            foreach ($items as $item) {
                $item['sale_id'] = $sale->id;
                SaleItem::create($item);
            }
        });

        return redirect()->route('sales.index')
                         ->with('success', 'Sale recorded successfully!');
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'saleItems.medicine', 'prescription']);
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        return redirect()->route('sales.index')
                         ->with('error', 'Sales cannot be edited. Please delete and recreate.');
    }

    public function update(Request $request, Sale $sale) {}

    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            // Restore stock
            foreach ($sale->saleItems as $item) {
                $item->medicine->increment('stock_quantity', $item->quantity);
            }
            $sale->saleItems()->delete();
            $sale->delete();
        });

        return redirect()->route('sales.index')
                         ->with('success', 'Sale deleted and stock restored!');
    }
}