<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    // Monthly sales report
    public function monthlySales(Request $request)
    {
        $year = $request->year ?? date('Y');

        $data = DB::select("
            SELECT
                MONTH(created_at)     AS month_num,
                MONTHNAME(created_at) AS month_name,
                COUNT(*)              AS total_sales,
                SUM(total_amount)     AS gross_amount,
                SUM(discount)         AS total_discount,
                SUM(paid_amount)      AS net_revenue
            FROM sales
            WHERE YEAR(created_at) = ?
              AND status = 'completed'
            GROUP BY MONTH(created_at), MONTHNAME(created_at)
            ORDER BY month_num ASC
        ", [$year]);

        return view('reports.monthly_sales', compact('data', 'year'));
    }

    // Top selling medicines
    public function topMedicines(Request $request)
    {
        $limit = $request->limit ?? 10;

        $data = DB::select("
            SELECT
                m.name                    AS medicine_name,
                m.generic_name,
                m.dosage_form,
                c.name                    AS category,
                SUM(si.quantity)          AS total_qty_sold,
                SUM(si.subtotal)          AS total_revenue,
                COUNT(DISTINCT si.sale_id) AS times_sold
            FROM sale_items si
            JOIN medicines m ON si.medicine_id = m.id
            JOIN categories c ON m.category_id = c.id
            JOIN sales s ON si.sale_id = s.id
            WHERE s.status = 'completed'
            GROUP BY m.id, m.name, m.generic_name, m.dosage_form, c.name
            ORDER BY total_qty_sold DESC
            LIMIT ?
        ", [$limit]);

        return view('reports.top_medicines', compact('data', 'limit'));
    }

    // Revenue by category
    public function categoryRevenue()
    {
        $data = DB::select("
            SELECT
                c.name            AS category,
                COUNT(DISTINCT m.id)  AS total_medicines,
                SUM(si.quantity)  AS total_sold,
                SUM(si.subtotal)  AS total_revenue
            FROM categories c
            JOIN medicines m   ON c.id  = m.category_id
            JOIN sale_items si ON m.id  = si.medicine_id
            JOIN sales s       ON si.sale_id = s.id
            WHERE s.status = 'completed'
            GROUP BY c.id, c.name
            ORDER BY total_revenue DESC
        ");

        return view('reports.category_revenue', compact('data'));
    }

    // Stock report
    public function stockReport()
    {
        $data = DB::select("
            SELECT
                m.name,
                m.generic_name,
                m.dosage_form,
                m.strength,
                m.stock_quantity,
                m.reorder_level,
                m.expiry_date,
                m.price,
                c.name AS category,
                s.name AS supplier,
                CASE
                    WHEN m.expiry_date < CURDATE()
                        THEN 'Expired'
                    WHEN m.stock_quantity <= m.reorder_level
                        THEN 'Low Stock'
                    WHEN m.expiry_date <= DATE_ADD(CURDATE(), INTERVAL 90 DAY)
                        THEN 'Expiring Soon'
                    ELSE 'Good'
                END AS status
            FROM medicines m
            JOIN categories c ON m.category_id = c.id
            JOIN suppliers  s ON m.supplier_id  = s.id
            ORDER BY
                CASE
                    WHEN m.expiry_date < CURDATE() THEN 1
                    WHEN m.stock_quantity <= m.reorder_level THEN 2
                    WHEN m.expiry_date <= DATE_ADD(CURDATE(), INTERVAL 90 DAY) THEN 3
                    ELSE 4
                END
        ");

        return view('reports.stock_report', compact('data'));
    }

    // Supplier purchase report
    public function supplierReport()
    {
        $data = DB::select("
            SELECT
                s.name              AS supplier,
                s.contact_person,
                s.phone,
                COUNT(p.id)         AS total_purchases,
                SUM(p.total_amount) AS total_spent,
                MAX(p.purchase_date) AS last_purchase
            FROM suppliers s
            LEFT JOIN purchases p ON s.id = p.supplier_id
            GROUP BY s.id, s.name, s.contact_person, s.phone
            ORDER BY total_spent DESC
        ");

        return view('reports.supplier_report', compact('data'));
    }
}