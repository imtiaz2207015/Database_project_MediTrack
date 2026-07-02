CREATE OR REPLACE PROCEDURE getsalessummary (
    p_start_date IN DATE,
    p_end_date IN DATE,
    p_cursor OUT SYS_REFCURSOR
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
        WHERE s.status = 'completed'
          AND TRUNC(s.created_at) BETWEEN p_start_date AND p_end_date
        GROUP BY TRUNC(s.created_at), s.payment_method
        ORDER BY sale_date DESC;
END getsalessummary;
/