CREATE OR REPLACE PROCEDURE get_top_medicines (
    p_limit  IN NUMBER,
    p_cursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT * FROM (
            SELECT 
                m.id,
                m.name AS medicine_name,
                m.generic_name,
                m.dosage_form,
                m.strength,
                c.name AS category,
                SUM(si.quantity) AS total_qty_sold,
                SUM(si.subtotal) AS total_revenue,
                COUNT(DISTINCT si.sale_id) AS times_sold
            FROM medicines m
            JOIN categories c ON c.id = m.category_id
            JOIN sale_items si ON si.medicine_id = m.id
            JOIN sales s ON s.id = si.sale_id
            WHERE s.status = 'completed'
            GROUP BY m.id, m.name, m.generic_name, m.dosage_form, m.strength, c.name
            ORDER BY total_qty_sold DESC
        )
        WHERE ROWNUM <= p_limit;
END get_top_medicines;
/