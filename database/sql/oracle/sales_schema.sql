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