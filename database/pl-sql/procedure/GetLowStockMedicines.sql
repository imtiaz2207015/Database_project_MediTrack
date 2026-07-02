CREATE OR REPLACE PROCEDURE getlowstockmedicines (
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
END getlowstockmedicines;
/