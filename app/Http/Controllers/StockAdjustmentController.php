<?php

namespace App\Http\Controllers;

use App\Models\StockAdjustment;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockAdjustmentController extends Controller
{
    public function index(Request $request)
    {
        $query = StockAdjustment::with(['medicine', 'user']);

        if ($request->filled('search')) {
            $query->whereHas('medicine', function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $adjustments = $query->latest()->paginate(15)->withQueryString();
        return view('stock_adjustments.index', compact('adjustments'));
    }

    public function create()
    {
        $medicines = Medicine::orderBy('name')->get();
        return view('stock_adjustments.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'type'        => 'required|in:increase,decrease',
            'quantity'    => 'required|integer|min:1',
            'reason'      => 'nullable|string|max:255',
        ]);

        $medicine = Medicine::findOrFail($request->medicine_id);

        if ($request->type === 'decrease' && $medicine->stock_quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock to decrease!');
        }

        StockAdjustment::create([
            'medicine_id' => $request->medicine_id,
            'user_id'     => Auth::id(),
            'type'        => $request->type,
            'quantity'    => $request->quantity,
            'reason'      => $request->reason,
        ]);

        if ($request->type === 'increase') {
            $medicine->increment('stock_quantity', $request->quantity);
        } else {
            $medicine->decrement('stock_quantity', $request->quantity);
        }

        return redirect()->route('stock-adjustments.index')
                         ->with('success', 'Stock adjusted successfully!');
    }

    public function show(StockAdjustment $stockAdjustment)
    {
        return view('stock_adjustments.show', compact('stockAdjustment'));
    }

    public function edit(StockAdjustment $stockAdjustment) {}
    public function update(Request $request, StockAdjustment $stockAdjustment) {}

    public function destroy(StockAdjustment $stockAdjustment)
    {
        $medicine = $stockAdjustment->medicine;

        if ($stockAdjustment->type === 'increase') {
            $medicine->decrement('stock_quantity', $stockAdjustment->quantity);
        } else {
            $medicine->increment('stock_quantity', $stockAdjustment->quantity);
        }

        $stockAdjustment->delete();

        return redirect()->route('stock-adjustments.index')
                         ->with('success', 'Adjustment deleted and stock reversed!');
    }
}