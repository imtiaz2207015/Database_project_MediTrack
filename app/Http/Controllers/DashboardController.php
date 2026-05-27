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
        // Summary cards
        $totalMedicines  = Medicine::count();
        $totalSales      = Sale::where('status', 'completed')->count();
        $totalCustomers  = Customer::count();
        $totalRevenue    = Sale::where('status', 'completed')->sum('paid_amount');

        // Low stock medicines
        $lowStock = Medicine::whereColumn('stock_quantity', '<=', 'reorder_level')
                            ->with('category')->get();

        // Expiring soon (within 90 days)
        $expiringSoon = Medicine::where('expiry_date', '<=', now()->addDays(90))
                                ->where('expiry_date', '>=', now())
                                ->orderBy('expiry_date')
                                ->get();

        // Recent sales
        $recentSales = Sale::with('customer')
                           ->latest()
                           ->take(5)
                           ->get();

        // Monthly sales for chart (last 6 months)
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