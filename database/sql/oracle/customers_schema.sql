
CREATE TABLE customers (
    id NUMBER(19,0) NOT NULL,
    name VARCHAR2(255) NOT NULL,
    phone VARCHAR2(255),
    email VARCHAR2(255),
    address CLOB,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT customers_id_pk PRIMARY KEY (id)
);