
CREATE TABLE customers (
    id NUMBER(19,0) NOT NULL,
    name VARCHAR2(255) NOT NULL,
    phone VARCHAR2(255),
    email VARCHAR2(255),
    address VARCHAR2(500),
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT customers_id_pk PRIMARY KEY (id)
);

INSERT INTO customers (id, name, phone, email, address, created_at, updated_at) VALUES (1, 'Md. Jahirul Islam', '01812000001', 'jahir@gmail.com', 'Mirpur, Dhaka', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO customers (id, name, phone, email, address, created_at, updated_at) VALUES (2, 'Fatema Khatun', '01812000002', 'fatema@gmail.com', 'Uttara, Dhaka', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO customers (id, name, phone, email, address, created_at, updated_at) VALUES (3, 'Rafiqul Hasan', '01812000003', NULL, 'Sylhet', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO customers (id, name, phone, email, address, created_at, updated_at) VALUES (4, 'Nasrin Akter', '01812000004', 'nasrin@gmail.com', 'Chittagong', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO customers (id, name, phone, email, address, created_at, updated_at) VALUES (5, 'Sabbir Rahman', '01812000005', NULL, 'Narayanganj', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO customers (id, name, phone, email, address, created_at, updated_at) VALUES (6, 'Kohinoor Begum', '01812000006', 'kohinoor@mail.com', 'Rajshahi', SYSTIMESTAMP, SYSTIMESTAMP);

-- Read all customers
SELECT * FROM customers;
SELECT * FROM customers WHERE id = 1;

-- Update a customer
UPDATE customers
SET phone = '01899999999', address = 'Rajshahi, Bangladesh', updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a customer
DELETE FROM customers WHERE id = 1;