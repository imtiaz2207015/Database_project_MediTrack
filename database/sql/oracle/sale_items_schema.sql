
CREATE TABLE sale_items (
    id NUMBER(19,0) NOT NULL,
    sale_id NUMBER(19,0) NOT NULL,
    medicine_id NUMBER(19,0) NOT NULL,
    quantity NUMBER(10,0) NOT NULL,
    unit_price NUMBER(10,2) NOT NULL,
    subtotal NUMBER(10,2) NOT NULL,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT sale_items_id_pk PRIMARY KEY (id),
    CONSTRAINT sale_items_sale_id_fk FOREIGN KEY (sale_id) REFERENCES sales (id) ON DELETE CASCADE,
    CONSTRAINT sale_items_medicine_id_fk FOREIGN KEY (medicine_id) REFERENCES medicines (id) ON DELETE CASCADE
);


INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (1, 1, 1, 5, 12, 60, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (2, 1, 4, 10, 2, 20, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (3, 1, 9, 3, 5, 15, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (4, 2, 2, 2, 35, 70, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (5, 2, 5, 1, 8, 8, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (6, 3, 7, 3, 10, 30, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (7, 3, 8, 1, 45, 45, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (8, 4, 13, 10, 9, 90, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (9, 4, 14, 10, 7, 70, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (10, 5, 4, 20, 2, 40, SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO sale_items (id, sale_id, medicine_id, quantity, unit_price, subtotal, created_at, updated_at) VALUES (11, 5, 10, 4, 6, 24, SYSTIMESTAMP, SYSTIMESTAMP);

-- Read all sale items
SELECT * FROM sale_items;
SELECT * FROM sale_items WHERE id = 1;
SELECT * FROM sale_items WHERE sale_id = 1;  -- all items in one sale


-- demo update
UPDATE sale_items
SET quantity = 6, subtotal = 72, updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a sale item (this will also delete associated sale_items due to ON DELETE CASCADE)
DELETE FROM sale_items WHERE id = 1;