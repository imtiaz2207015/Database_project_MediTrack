
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