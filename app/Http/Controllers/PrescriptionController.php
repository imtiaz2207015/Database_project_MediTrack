<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::with(['customer', 'sale']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('doctor_name', 'like', "%$search%")
                  ->orWhereHas('customer', function($q2) use ($search) {
                      $q2->where('name', 'like', "%$search%");
                  });
            });
        }

        if ($request->filled('date_from')) {
            $query->where('prescribed_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('prescribed_date', '<=', $request->date_to);
        }

        $prescriptions = $query->latest()->paginate(15)->withQueryString();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $sales     = Sale::with('customer')->latest()->take(50)->get();
        return view('prescriptions.create', compact('customers', 'sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'     => 'required|exists:customers,id',
            'doctor_name'     => 'required|string|max:255',
            'doctor_phone'    => 'nullable|string|max:20',
            'prescribed_date' => 'required|date',
            'notes'           => 'nullable|string',
            'sale_id'         => 'nullable|exists:sales,id',
        ]);

        Prescription::create($request->all());

        return redirect()->route('prescriptions.index')
                         ->with('success', 'Prescription added successfully!');
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['customer', 'sale.saleItems.medicine']);
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $customers = Customer::orderBy('name')->get();
        $sales     = Sale::with('customer')->latest()->take(50)->get();
        return view('prescriptions.edit', compact('prescription', 'customers', 'sales'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'customer_id'     => 'required|exists:customers,id',
            'doctor_name'     => 'required|string|max:255',
            'doctor_phone'    => 'nullable|string|max:20',
            'prescribed_date' => 'required|date',
            'notes'           => 'nullable|string',
            'sale_id'         => 'nullable|exists:sales,id',
        ]);

        $prescription->update($request->all());

        return redirect()->route('prescriptions.index')
                         ->with('success', 'Prescription updated successfully!');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')
                         ->with('success', 'Prescription deleted successfully!');
    }
}