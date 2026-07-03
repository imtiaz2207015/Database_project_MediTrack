<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Stored Procedure 1: Low stock medicines
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetLowStockMedicines (
                p_cursor OUT SYS_REFCURSOR
            )
            AS
            BEGIN
                OPEN p_cursor FOR
                    SELECT 
                        m.id,
                        m.name,
                        m.generic_name,
                        m.brand,
                        m.dosage_form,
                        m.strength,
                        m.stock_quantity,
                        m.reorder_level,
                        m.expiry_date,
                        c.name AS category_name,
                        s.name AS supplier_name
                    FROM medicines m
                    JOIN categories c ON m.category_id = c.id
                    JOIN suppliers s ON m.supplier_id = s.id
                    WHERE m.stock_quantity <= m.reorder_level
                    ORDER BY m.stock_quantity ASC;
            END GetLowStockMedicines;
        ');

        // Stored Procedure 2: Sales summary for a date range (by day + payment method)
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetSalesSummary (
                p_start_date IN DATE,
                p_end_date   IN DATE,
                p_cursor     OUT SYS_REFCURSOR
            )
            AS
            BEGIN
                OPEN p_cursor FOR
                    SELECT 
                        TRUNC(s.created_at) AS sale_date,
                        s.payment_method,
                        COUNT(*) AS total_transactions,
                        SUM(s.total_amount) AS total_sales,
                        SUM(s.discount) AS total_discount,
                        SUM(s.paid_amount) AS total_collected
                    FROM sales s
                    WHERE s.status = \'completed\'
                      AND TRUNC(s.created_at) BETWEEN p_start_date AND p_end_date
                    GROUP BY TRUNC(s.created_at), s.payment_method
                    ORDER BY sale_date DESC;
            END GetSalesSummary;
        ');

        // Stored Procedure 3: Top customers by spending
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetTopCustomers (
                p_limit  IN NUMBER,
                p_cursor OUT SYS_REFCURSOR
            )
            AS
            BEGIN
                OPEN p_cursor FOR
                    SELECT * FROM (
                        SELECT 
                            c.id,
                            c.name,
                            c.phone,
                            c.email,
                            COUNT(s.id) AS total_orders,
                            SUM(s.total_amount) AS total_spent
                        FROM customers c
                        JOIN sales s ON s.customer_id = c.id
                        WHERE s.status = \'completed\'
                        GROUP BY c.id, c.name, c.phone, c.email
                        ORDER BY total_spent DESC
                    )
                    WHERE ROWNUM <= p_limit;
            END GetTopCustomers;
        ');

        // Stored Procedure 4: Top selling medicines by quantity
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetTopMedicines (
                p_limit  IN NUMBER,
                p_cursor OUT SYS_REFCURSOR
            )
            AS
            BEGIN
                OPEN p_cursor FOR
                    SELECT * FROM (
                        SELECT 
                            m.id,
                            m.name,
                            m.dosage_form,
                            m.strength,
                            SUM(si.quantity) AS total_quantity_sold,
                            SUM(si.subtotal) AS total_revenue
                        FROM medicines m
                        JOIN sale_items si ON si.medicine_id = m.id
                        JOIN sales s ON s.id = si.sale_id
                        WHERE s.status = \'completed\'
                        GROUP BY m.id, m.name, m.dosage_form, m.strength
                        ORDER BY total_quantity_sold DESC
                    )
                    WHERE ROWNUM <= p_limit;
            END GetTopMedicines;
        ');

        // Stored Procedure 5: Supplier purchase report with medicines supplied
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE GetSupplierReport (
                p_cursor OUT SYS_REFCURSOR
            )
            AS
            BEGIN
                OPEN p_cursor FOR
                    SELECT 
                        s.id AS supplier_id,
                        s.name AS supplier_name,
                        s.phone,
                        s.email,
                        supplier_totals.total_orders,
                        supplier_totals.total_purchase_amount,
                        m.id AS medicine_id,
                        m.name AS medicine_name,
                        m.stock_quantity
                    FROM suppliers s
                    JOIN medicines m ON m.supplier_id = s.id
                    JOIN (
                        SELECT 
                            p.supplier_id,
                            COUNT(DISTINCT p.id) AS total_orders,
                            SUM(p.total_amount) AS total_purchase_amount
                        FROM purchases p
                        WHERE p.status = \'received\'
                        GROUP BY p.supplier_id
                    ) supplier_totals ON supplier_totals.supplier_id = s.id
                    ORDER BY s.name, m.name;
            END GetSupplierReport;
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
        DB::unprepared('DROP PROCEDURE GetTopMedicines');
        DB::unprepared('DROP PROCEDURE GetSupplierReport');
        DB::unprepared('DROP TRIGGER after_sale_item_insert');
        DB::unprepared('DROP TRIGGER after_sale_item_delete');
        DB::unprepared('DROP TRIGGER after_purchase_item_insert');
        DB::unprepared('DROP TRIGGER after_purchase_item_delete');
    }
};