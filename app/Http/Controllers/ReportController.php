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

    public function monthlySales(Request $request)
    {
        $year = $request->year ?? date('Y');

        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN get_monthly_sales(:p_year, :p_cursor); END;");
        $stmt->bindParam(':p_year',   $year,   \PDO::PARAM_INT);
        $cursor = null;
        $stmt->bindParam(':p_cursor', $cursor, \PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $data = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $data[] = (object) array_change_key_case($row, CASE_LOWER);
        }

        return view('reports.monthly_sales', compact('data', 'year'));
    }

    public function topMedicines(Request $request)
    {
        $limit = (int) ($request->limit ?? 10);

        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN get_top_medicines(:p_limit, :p_cursor); END;");
        $stmt->bindParam(':p_limit',  $limit,  \PDO::PARAM_INT);
        $cursor = null;
        $stmt->bindParam(':p_cursor', $cursor, \PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $data = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $data[] = (object) array_change_key_case($row, CASE_LOWER);
        }

        return view('reports.top_medicines', compact('data', 'limit'));
    }

    public function categoryRevenue()
    {
        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN get_category_revenue(:p_cursor); END;");
        $cursor = null;
        $stmt->bindParam(':p_cursor', $cursor, \PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $data = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $data[] = (object) array_change_key_case($row, CASE_LOWER);
        }

        return view('reports.category_revenue', compact('data'));
    }

    public function stockReport()
    {
        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN get_stock_report(:p_cursor); END;");
        $cursor = null;
        $stmt->bindParam(':p_cursor', $cursor, \PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $data = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $data[] = (object) array_change_key_case($row, CASE_LOWER);
        }

        return view('reports.stock_report', compact('data'));
    }

    public function supplierReport()
    {
        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN get_supplier_report(:p_cursor); END;");
        $cursor = null;
        $stmt->bindParam(':p_cursor', $cursor, \PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $data = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $data[] = (object) array_change_key_case($row, CASE_LOWER);
        }

        return view('reports.supplier_report', compact('data'));
    }
}