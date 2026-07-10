CREATE TABLE stock_adjustments (
    id NUMBER(19,0) NOT NULL,
    medicine_id NUMBER(19,0) NOT NULL,
    user_id NUMBER(19,0) NOT NULL,
    type VARCHAR2(255) NOT NULL,
    quantity NUMBER(10,0) NOT NULL,
    reason VARCHAR2(255),
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT stock_adjustments_id_pk PRIMARY KEY (id),
    CONSTRAINT chk_type CHECK (type in ('increase', 'decrease')),
    CONSTRAINT stock_adjustments_medicine_id_fk FOREIGN KEY (medicine_id) REFERENCES medicines (id) ON DELETE CASCADE,
    CONSTRAINT stock_adjustments_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);


INSERT INTO stock_adjustments (id, medicine_id, user_id, type, quantity, reason, created_at, updated_at) VALUES (1, 8, 1, 'decrease', 5, 'Damaged bottles found in storage', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO stock_adjustments (id, medicine_id, user_id, type, quantity, reason, created_at, updated_at) VALUES (2, 15, 2, 'decrease', 3, 'Expired stock removed', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO stock_adjustments (id, medicine_id, user_id, type, quantity, reason, created_at, updated_at) VALUES (3, 4, 1, 'increase', 100, 'Emergency restock from local supplier', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO stock_adjustments (id, medicine_id, user_id, type, quantity, reason, created_at, updated_at) VALUES (4, 11, 3, 'decrease', 10, 'Donated to health camp', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO stock_adjustments (id, medicine_id, user_id, type, quantity, reason, created_at, updated_at) VALUES (5, 7, 2, 'increase', 50, 'Bonus stock from supplier promotion', SYSTIMESTAMP, SYSTIMESTAMP);

-- Read all stock adjustments
SELECT * FROM stock_adjustments;
SELECT * FROM stock_adjustments WHERE id = 1;


-- Update a stock adjustment
UPDATE stock_adjustments
SET reason = 'Expired stock removed, verified by pharmacist', updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a stock adjustment (this will also delete associated stock_adjustments due to ON DELETE CASCADE)
DELETE FROM stock_adjustments WHERE id = 1;