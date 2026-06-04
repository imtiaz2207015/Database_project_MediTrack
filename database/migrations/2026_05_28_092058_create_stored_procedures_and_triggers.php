<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Stored Procedure 1: Low stock medicines
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetLowStockMedicines
            AS
            BEGIN
                FOR r IN (
                    SELECT m.name, m.stock_quantity, m.reorder_level,
                           c.name AS category, s.name AS supplier
                    FROM medicines m
                    JOIN categories c ON m.category_id = c.id
                    JOIN suppliers  s ON m.supplier_id  = s.id
                    WHERE m.stock_quantity <= m.reorder_level
                    ORDER BY m.stock_quantity ASC
                ) LOOP
                    DBMS_OUTPUT.PUT_LINE(r.name || \' | \' || r.stock_quantity);
                END LOOP;
            END;
        ');

        // Stored Procedure 2: Sales summary for a date range
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetSalesSummary(
                p_start_date IN DATE,
                p_end_date   IN DATE,
                p_total_sales    OUT NUMBER,
                p_gross_revenue  OUT NUMBER,
                p_total_discount OUT NUMBER,
                p_net_revenue    OUT NUMBER,
                p_avg_sale_value OUT NUMBER
            )
            AS
            BEGIN
                SELECT
                    COUNT(*),
                    SUM(total_amount),
                    SUM(discount),
                    SUM(paid_amount),
                    AVG(paid_amount)
                INTO
                    p_total_sales,
                    p_gross_revenue,
                    p_total_discount,
                    p_net_revenue,
                    p_avg_sale_value
                FROM sales
                WHERE TRUNC(created_at) BETWEEN p_start_date AND p_end_date
                  AND status = \'completed\';
            END;
        ');

        // Stored Procedure 3: Top customers by spending
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetTopCustomers(
                p_top_n IN NUMBER
            )
            AS
            BEGIN
                FOR r IN (
                    SELECT *
                    FROM (
                        SELECT
                            c.name,
                            c.phone,
                            COUNT(s.id)        AS total_purchases,
                            SUM(s.paid_amount) AS total_spent
                        FROM customers c
                        JOIN sales s ON c.id = s.customer_id
                        WHERE s.status = \'completed\'
                        GROUP BY c.id, c.name, c.phone
                        ORDER BY SUM(s.paid_amount) DESC
                    )
                    WHERE ROWNUM <= p_top_n
                ) LOOP
                    DBMS_OUTPUT.PUT_LINE(r.name || \' | \' || r.total_spent);
                END LOOP;
            END;
        ');

        // Trigger 1: Decrease stock after sale item insert
        DB::unprepared('
            CREATE OR REPLACE TRIGGER after_sale_item_insert
            AFTER INSERT ON sale_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity - :NEW.quantity
                WHERE id = :NEW.medicine_id;
            END;
        ');

        // Trigger 2: Restore stock after sale item delete
        DB::unprepared('
            CREATE OR REPLACE TRIGGER after_sale_item_delete
            AFTER DELETE ON sale_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity + :OLD.quantity
                WHERE id = :OLD.medicine_id;
            END;
        ');

        // Trigger 3: Increase stock after purchase item insert
        DB::unprepared('
            CREATE OR REPLACE TRIGGER after_purchase_item_insert
            AFTER INSERT ON purchase_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity + :NEW.quantity
                WHERE id = :NEW.medicine_id;
            END;
        ');

        // Trigger 4: Reverse stock after purchase item delete
        DB::unprepared('
            CREATE OR REPLACE TRIGGER after_purchase_item_delete
            AFTER DELETE ON purchase_items
            FOR EACH ROW
            BEGIN
                UPDATE medicines
                SET stock_quantity = stock_quantity - :OLD.quantity
                WHERE id = :OLD.medicine_id;
            END;
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE GetLowStockMedicines');
        DB::unprepared('DROP PROCEDURE GetSalesSummary');
        DB::unprepared('DROP PROCEDURE GetTopCustomers');
        DB::unprepared('DROP TRIGGER after_sale_item_insert');
        DB::unprepared('DROP TRIGGER after_sale_item_delete');
        DB::unprepared('DROP TRIGGER after_purchase_item_insert');
        DB::unprepared('DROP TRIGGER after_purchase_item_delete');
    }
};