<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ── Stored Procedure 1: Low stock medicines ──
        DB::unprepared('
            CREATE PROCEDURE GetLowStockMedicines()
            BEGIN
                SELECT m.name, m.stock_quantity, m.reorder_level,
                       c.name AS category, s.name AS supplier
                FROM medicines m
                JOIN categories c ON m.category_id = c.id
                JOIN suppliers  s ON m.supplier_id  = s.id
                WHERE m.stock_quantity <= m.reorder_level
                ORDER BY m.stock_quantity ASC;
            END
        ');

        // ── Stored Procedure 2: Sales summary for a date range ──
        DB::unprepared('
            CREATE PROCEDURE GetSalesSummary(IN start_date DATE, IN end_date DATE)
            BEGIN
                SELECT
                    COUNT(*)         AS total_sales,
                    SUM(total_amount) AS gross_revenue,
                    SUM(discount)    AS total_discount,
                    SUM(paid_amount) AS net_revenue,
                    AVG(paid_amount) AS avg_sale_value
                FROM sales
                WHERE DATE(created_at) BETWEEN start_date AND end_date
                  AND status = "completed";
            END
        ');

        // ── Stored Procedure 3: Top customers by spending ──
        DB::unprepared('
            CREATE PROCEDURE GetTopCustomers(IN top_n INT)
            BEGIN
                SELECT
                    c.name,
                    c.phone,
                    COUNT(s.id)      AS total_purchases,
                    SUM(s.paid_amount) AS total_spent
                FROM customers c
                JOIN sales s ON c.id = s.customer_id
                WHERE s.status = "completed"
                GROUP BY c.id, c.name, c.phone
                ORDER BY total_spent DESC
                LIMIT top_n;
            END
        ');

        // ── Trigger 1: Decrease stock after sale item insert ──
        DB::unprepared('
            CREATE TRIGGER after_sale_item_insert
            AFTER INSERT ON sale_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity - NEW.quantity
                WHERE id = NEW.medicine_id;
            END
        ');

        // ── Trigger 2: Restore stock after sale item delete ──
        DB::unprepared('
            CREATE TRIGGER after_sale_item_delete
            AFTER DELETE ON sale_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity + OLD.quantity
                WHERE id = OLD.medicine_id;
            END
        ');

        // ── Trigger 3: Increase stock after purchase item insert ──
        DB::unprepared('
            CREATE TRIGGER after_purchase_item_insert
            AFTER INSERT ON purchase_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity + NEW.quantity
                WHERE id = NEW.medicine_id;
            END
        ');

        // ── Trigger 4: Reverse stock after purchase item delete ──
        DB::unprepared('
            CREATE TRIGGER after_purchase_item_delete
            AFTER DELETE ON purchase_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity - OLD.quantity
                WHERE id = OLD.medicine_id;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetLowStockMedicines');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetSalesSummary');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetTopCustomers');
        DB::unprepared('DROP TRIGGER IF EXISTS after_sale_item_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_sale_item_delete');
        DB::unprepared('DROP TRIGGER IF EXISTS after_purchase_item_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_purchase_item_delete');
    }
};