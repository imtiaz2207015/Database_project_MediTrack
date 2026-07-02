CREATE TABLE prescriptions (
    id NUMBER(19,0) NOT NULL,
    customer_id NUMBER(19,0) NOT NULL,
    sale_id NUMBER(19,0),
    doctor_name VARCHAR2(255) NOT NULL,
    doctor_phone VARCHAR2(255),
    notes CLOB,
    prescribed_date DATE NOT NULL,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT prescriptions_id_pk PRIMARY KEY (id),
    CONSTRAINT prescriptions_customer_id_fk FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE CASCADE,
    CONSTRAINT prescriptions_sale_id_fk FOREIGN KEY (sale_id) REFERENCES sales (id) ON DELETE SET NULL
);