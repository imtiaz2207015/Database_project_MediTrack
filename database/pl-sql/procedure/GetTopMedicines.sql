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
            WHERE s.status = 'completed'
            GROUP BY m.id, m.name, m.dosage_form, m.strength
            ORDER BY total_quantity_sold DESC
        )
        WHERE ROWNUM <= p_limit;
END GetTopMedicines;
/