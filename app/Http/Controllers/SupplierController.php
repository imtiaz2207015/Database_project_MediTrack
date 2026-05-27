<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::withCount('medicines');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('contact_person', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        $suppliers = $query->orderBy('name')->paginate(15)->withQueryString();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier added successfully!');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load('medicines', 'purchases');
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'nullable|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->medicines()->count() > 0) {
            return redirect()->route('suppliers.index')
                             ->with('error', 'Cannot delete — medicines are linked to this supplier!');
        }

        $supplier->delete();
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier deleted successfully!');
    }
}