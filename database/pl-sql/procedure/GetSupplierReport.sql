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
            WHERE p.status = 'received'
            GROUP BY p.supplier_id
        ) supplier_totals ON supplier_totals.supplier_id = s.id
        ORDER BY s.name, m.name;
END GetSupplierReport;
/