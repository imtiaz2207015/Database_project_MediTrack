
CREATE TABLE suppliers (
    id NUMBER(19,0) NOT NULL,
    name VARCHAR2(255) NOT NULL,
    contact_person VARCHAR2(255),
    phone VARCHAR2(255) NOT NULL,
    email VARCHAR2(255),
    address CLOB,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT suppliers_id_pk PRIMARY KEY (id)
);