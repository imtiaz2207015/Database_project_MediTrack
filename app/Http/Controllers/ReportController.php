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
        $startDate = $request->start_date ?? date('Y-01-01');
        $endDate   = $request->end_date ?? date('Y-m-d');

        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN GetSalesSummary(:p_start, :p_end, :p_cursor); END;");
        $stmt->bindParam(':p_start',  $startDate, \PDO::PARAM_STR);
        $stmt->bindParam(':p_end',    $endDate,   \PDO::PARAM_STR);
        $cursor = null;
        $stmt->bindParam(':p_cursor', $cursor, \PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $data = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $data[] = (object) array_change_key_case($row, CASE_LOWER);
        }

        return view('reports.monthly_sales', compact('data', 'startDate', 'endDate'));
    }

    public function stockReport()
    {
        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN GetLowStockMedicines(:p_cursor); END;");
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

    public function topCustomers(Request $request)
    {
        $limit = (int) ($request->limit ?? 5);

        $pdo  = DB::getPdo();
        $stmt = $pdo->prepare("BEGIN GetTopCustomers(:p_limit, :p_cursor); END;");
        $stmt->bindParam(':p_limit',  $limit, \PDO::PARAM_INT);
        $cursor = null;
        $stmt->bindParam(':p_cursor', $cursor, \PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $data = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $data[] = (object) array_change_key_case($row, CASE_LOWER);
        }

        return view('reports.top_customers', compact('data', 'limit'));
    }

public function topMedicines(Request $request)
{
    $limit = (int) ($request->limit ?? 5);

    $pdo  = DB::getPdo();
    $stmt = $pdo->prepare("BEGIN GetTopMedicines(:p_limit, :p_cursor); END;");
    $stmt->bindParam(':p_limit',  $limit, \PDO::PARAM_INT);
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

public function supplierReport()
{
    $pdo  = DB::getPdo();
    $stmt = $pdo->prepare("BEGIN GetSupplierReport(:p_cursor); END;");
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