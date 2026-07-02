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