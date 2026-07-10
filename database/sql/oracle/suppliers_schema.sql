
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

INSERT INTO suppliers (id, name, contact_person, phone, email, address, created_at, updated_at) VALUES (1, 'Square Pharmaceuticals', 'Karim Hossain', '01711000001', 'square@pharma.com', 'Dhaka, Bangladesh', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO suppliers (id, name, contact_person, phone, email, address, created_at, updated_at) VALUES (2, 'Beximco Pharma', 'Nadia Islam', '01711000002', 'beximco@pharma.com', 'Gazipur, Bangladesh', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO suppliers (id, name, contact_person, phone, email, address, created_at, updated_at) VALUES (3, 'Incepta Pharmaceuticals', 'Tariq Ahmed', '01711000003', 'incepta@pharma.com', 'Dhamrai, Bangladesh', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO suppliers (id, name, contact_person, phone, email, address, created_at, updated_at) VALUES (4, 'Opsonin Pharma', 'Ritu Sharma', '01711000004', 'opsonin@pharma.com', 'Narayanganj, BD', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO suppliers (id, name, contact_person, phone, email, address, created_at, updated_at) VALUES (5, 'ACI Limited', 'Mostofa Kamal', '01711000005', 'aci@pharma.com', 'Tejgaon, Dhaka', SYSTIMESTAMP, SYSTIMESTAMP);

--- Read all suppliers
SELECT * FROM suppliers;
SELECT * FROM suppliers WHERE id = 1;

-- demo update
UPDATE suppliers
SET phone = '01711111111', email = 'square.updated@example.com', address = 'Uttara, Dhaka', updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a supplier
DELETE FROM suppliers WHERE id = 1;