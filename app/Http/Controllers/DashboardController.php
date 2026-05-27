<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMedicines = Medicine::count();
        $totalSales     = Sale::where('status', 'completed')->count();
        $totalCustomers = Customer::count();
        $totalRevenue   = Sale::where('status', 'completed')->sum('paid_amount');

        $lowStock = Medicine::whereColumn('stock_quantity', '<=', 'reorder_level')
                            ->with('category')->get();

        $expiringSoon = Medicine::where('expiry_date', '<=', now()->addDays(90))
                                ->where('expiry_date', '>=', now())
                                ->orderBy('expiry_date')
                                ->get();

        $recentSales = Sale::with('customer')
                           ->latest()
                           ->take(5)
                           ->get();

        $monthlySales = Sale::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(paid_amount) as total')
            )
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard', compact(
            'totalMedicines', 'totalSales', 'totalCustomers', 'totalRevenue',
            'lowStock', 'expiringSoon', 'recentSales', 'monthlySales'
        ));
    }
}