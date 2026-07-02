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