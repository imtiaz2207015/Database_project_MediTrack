CREATE TABLE purchases (
    id NUMBER(19,0) NOT NULL,
    supplier_id NUMBER(19,0) NOT NULL,
    user_id NUMBER(19,0) NOT NULL,
    total_amount NUMBER(10,2) NOT NULL,
    status VARCHAR2(255) DEFAULT 'received' NOT NULL,
    purchase_date DATE NOT NULL,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT chk_purchase_status CHECK (status IN ('received','pending','cancelled')),
    CONSTRAINT purchases_id_pk PRIMARY KEY (id),
    CONSTRAINT purchases_supplier_id_fk FOREIGN KEY (supplier_id) REFERENCES suppliers (id) ON DELETE CASCADE,
    CONSTRAINT purchases_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);


INSERT INTO purchases (id, supplier_id, user_id, total_amount, status, purchase_date, created_at, updated_at) VALUES (1, 1, 1, 5000, 'received', TO_DATE('2025-05-01', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchases (id, supplier_id, user_id, total_amount, status, purchase_date, created_at, updated_at) VALUES (2, 2, 2, 3200, 'received', TO_DATE('2025-05-05', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchases (id, supplier_id, user_id, total_amount, status, purchase_date, created_at, updated_at) VALUES (3, 3, 1, 2800, 'pending', TO_DATE('2025-05-10', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchases (id, supplier_id, user_id, total_amount, status, purchase_date, created_at, updated_at) VALUES (4, 4, 3, 1500, 'received', TO_DATE('2025-05-12', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);


-- Read all purchases
SELECT * FROM purchases;
SELECT * FROM purchases WHERE id = 1;


-- demo update
UPDATE purchases
SET status = 'received', updated_at = SYSTIMESTAMP
WHERE id = 3;

-- Delete a purchase (this will also delete associated purchase_items due to ON DELETE CASCADE)
DELETE FROM purchases WHERE id = 1;