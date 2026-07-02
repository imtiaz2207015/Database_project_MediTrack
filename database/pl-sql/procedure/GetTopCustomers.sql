CREATE OR REPLACE PROCEDURE gettopcustomers (
    p_limit IN NUMBER,
    p_cursor OUT SYS_REFCURSOR
)
AS
BEGIN
    OPEN p_cursor FOR
        SELECT *
        FROM (
            SELECT
                c.id,
                c.name,
                c.phone,
                c.email,
                COUNT(s.id) AS total_orders,
                SUM(s.total_amount) AS total_spent
            FROM customers c
            JOIN sales s ON s.customer_id = c.id
            WHERE s.status = 'completed'
            GROUP BY c.id, c.name, c.phone, c.email
            ORDER BY total_spent DESC
        )
        WHERE ROWNUM <= p_limit;
END gettopcustomers;
/