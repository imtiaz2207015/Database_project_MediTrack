CREATE TABLE purchase_items (
    id NUMBER(19,0) NOT NULL,
    purchase_id NUMBER(19,0) NOT NULL,
    medicine_id NUMBER(19,0) NOT NULL,
    quantity NUMBER(10,0) NOT NULL,
    unit_price NUMBER(10,2) NOT NULL,
    subtotal NUMBER(10,2) NOT NULL,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT purchase_items_id_pk PRIMARY KEY (id),
    CONSTRAINT purchase_items_purchase_id_fk FOREIGN KEY (purchase_id) REFERENCES purchases (id) ON DELETE CASCADE,
    CONSTRAINT purchase_items_medicine_id_fk FOREIGN KEY (medicine_id) REFERENCES medicines (id) ON DELETE CASCADE
);


INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (1, 1, 1, 500, 8, 4000, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (2, 1, 4, 500, 1, 500, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (3, 1, 11, 100, 2, 200, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (4, 2, 2, 200, 22, 4400, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (5, 2, 9, 300, 3, 900, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (6, 3, 3, 200, 12, 2400, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (7, 3, 14, 200, 4, 800, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (8, 4, 6, 150, 4, 600, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO purchase_items (id, purchase_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (9, 4, 12, 100, 9, 900, SYSTIMESTAMP, SYSTIMESTAMP);


-- Read all purchase items
SELECT * FROM purchase_items;
SELECT * FROM purchase_items WHERE id = 1;
SELECT * FROM purchase_items WHERE purchase_id = 1;  -- all items in one purchase


-- demo update
UPDATE purchase_items
SET quantity = 600, subtotal = 4800, updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a purchase item (this will also delete associated purchase_items due to ON DELETE CASCADE)
DELETE FROM purchase_items WHERE id = 1;