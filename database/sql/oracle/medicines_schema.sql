
CREATE TABLE medicines (
    id NUMBER(19,0) NOT NULL,
    category_id NUMBER(19,0) NOT NULL,
    supplier_id NUMBER(19,0) NOT NULL,
    name VARCHAR2(255) NOT NULL,
    generic_name VARCHAR2(255),
    brand VARCHAR2(255),
    dosage_form VARCHAR2(255) NOT NULL,
    strength VARCHAR2(255),
    price NUMBER(10,2) NOT NULL,
    stock_quantity NUMBER(10,0) DEFAULT '0' NOT NULL,
    reorder_level NUMBER(10,0) DEFAULT '10' NOT NULL,
    expiry_date DATE NOT NULL,
    batch_number VARCHAR2(255),
    description CLOB,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT chk_dosage_form CHECK (dosage_form IN ('tablet','capsule','syrup','injection','cream','drops','other')),
    CONSTRAINT medicines_id_pk PRIMARY KEY (id),
    CONSTRAINT medicines_category_id_fk FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE,
    CONSTRAINT medicines_supplier_id_fk FOREIGN KEY (supplier_id) REFERENCES suppliers (id) ON DELETE CASCADE
);