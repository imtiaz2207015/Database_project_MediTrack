<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicine::with(['category', 'supplier']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('generic_name', 'like', "%" . $search . "%")
                  ->orWhere('brand', 'like', "%" . $search . "%")
                  ->orWhere('batch_number', 'like', "%" . $search . "%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('dosage_form')) {
            $query->where('dosage_form', $request->dosage_form);
        }

        if ($request->filter === 'low_stock') {
            $query->whereColumn('stock_quantity', '<=', 'reorder_level');
        }

        $sortBy  = in_array($request->sort_by, ['name','price','stock_quantity','expiry_date']) ? $request->sort_by : 'name';
        $sortDir = $request->sort_dir === 'desc' ? 'desc' : 'asc';
        $query->orderBy($sortBy, $sortDir);

        $medicines  = $query->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('medicines.index', compact('medicines', 'categories', 'sortBy', 'sortDir'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();
        return view('medicines.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'dosage_form'    => 'required',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'reorder_level'  => 'required|integer|min:0',
            'expiry_date'    => 'required|date|after:today',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')
                         ->with('success', 'Medicine added successfully!');
    }

    public function show(Medicine $medicine)
    {
        $medicine->load(['category', 'supplier', 'saleItems.sale', 'stockAdjustments']);
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();
        return view('medicines.edit', compact('medicine', 'categories', 'suppliers'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'dosage_form'    => 'required',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'reorder_level'  => 'required|integer|min:0',
            'expiry_date'    => 'required|date',
        ]);

        $medicine->update($request->all());

        return redirect()->route('medicines.index')
                         ->with('success', 'Medicine updated successfully!');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')
                         ->with('success', 'Medicine deleted successfully!');
    }
}