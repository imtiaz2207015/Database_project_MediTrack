CREATE TABLE sales (
    id NUMBER(19,0) NOT NULL,
    customer_id NUMBER(19,0),
    user_id NUMBER(19,0) NOT NULL,
    total_amount NUMBER(10,2) NOT NULL,
    discount NUMBER(10,2) DEFAULT '0' NOT NULL,
    paid_amount NUMBER(10,2) NOT NULL,
    payment_method VARCHAR2(255) DEFAULT 'cash' NOT NULL,
    status VARCHAR2(255) DEFAULT 'completed' NOT NULL,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT chk_payment_method CHECK (payment_method IN ('cash','card','mobile_banking')),
    CONSTRAINT chk_sales_status CHECK (status IN ('completed','pending','cancelled')),
    CONSTRAINT sales_id_pk PRIMARY KEY (id),
    CONSTRAINT sales_customer_id_fk FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE SET NULL,
    CONSTRAINT sales_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

INSERT INTO sales (id, customer_id, user_id, total_amount, discount, paid_amount, payment_method, status, created_at, updated_at) VALUES (1, 1, 1, 119, 0, 119, 'cash', 'completed', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sales (id, customer_id, user_id, total_amount, discount, paid_amount, payment_method, status, created_at, updated_at) VALUES (2, 2, 2, 85, 5, 80, 'mobile_banking', 'completed', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sales (id, customer_id, user_id, total_amount, discount, paid_amount, payment_method, status, created_at, updated_at) VALUES (3, 3, 1, 46, 0, 46, 'cash', 'completed', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sales (id, customer_id, user_id, total_amount, discount, paid_amount, payment_method, status, created_at, updated_at) VALUES (4, 4, 3, 200, 10, 190, 'card', 'completed', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sales (id, customer_id, user_id, total_amount, discount, paid_amount, payment_method, status, created_at, updated_at) VALUES (5, 5, 2, 60, 0, 60, 'cash', 'pending', SYSTIMESTAMP, SYSTIMESTAMP);

--read all sales
SELECT * FROM sales;
SELECT * FROM sales WHERE id = 1;


-- demo update
UPDATE sales
SET status = 'cancelled', updated_at = SYSTIMESTAMP
WHERE id = 5;

-- Delete a sale (this will also delete associated sale_items due to ON DELETE CASCADE)
DELETE FROM sales WHERE id = 1;