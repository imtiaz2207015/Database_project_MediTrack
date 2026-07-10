CREATE TABLE prescriptions (
    id NUMBER(19,0) NOT NULL,
    customer_id NUMBER(19,0) NOT NULL,
    sale_id NUMBER(19,0),
    doctor_name VARCHAR2(255) NOT NULL,
    doctor_phone VARCHAR2(255),
    notes VARCHAR2(500),
    prescribed_date DATE NOT NULL,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT prescriptions_id_pk PRIMARY KEY (id),
    CONSTRAINT prescriptions_customer_id_fk FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE CASCADE,
    CONSTRAINT prescriptions_sale_id_fk FOREIGN KEY (sale_id) REFERENCES sales (id) ON DELETE SET NULL
);


INSERT INTO prescriptions (id, customer_id, sale_id, doctor_name, doctor_phone, notes, prescribed_date, created_at, updated_at) VALUES (1, 1, 1, 'Dr. Anwar Hossain', '01911111101', 'Take after meals. Full course required.', TO_DATE('2025-05-20', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO prescriptions (id, customer_id, sale_id, doctor_name, doctor_phone, notes, prescribed_date, created_at, updated_at) VALUES (2, 2, 2, 'Dr. Shahana Parvin', '01911111102', 'Avoid cold water.', TO_DATE('2025-05-18', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO prescriptions (id, customer_id, sale_id, doctor_name, doctor_phone, notes, prescribed_date, created_at, updated_at) VALUES (3, 4, 4, 'Dr. Rafiq Uddin', '01911111103', 'Check BP weekly. Low sodium diet.', TO_DATE('2025-05-15', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO prescriptions (id, customer_id, sale_id, doctor_name, doctor_phone, notes, prescribed_date, created_at, updated_at) VALUES (4, 6, NULL, 'Dr. Mitu Akter', '01911111104', 'Vitamin deficiency noted.', TO_DATE('2025-05-22', 'YYYY-MM-DD'), SYSTIMESTAMP, SYSTIMESTAMP);

-- Read all prescriptions
SELECT * FROM prescriptions;
SELECT * FROM prescriptions WHERE id = 1;

-- Update a prescription
UPDATE prescriptions
SET notes = 'Take after meals for 7 days', updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a prescription (this will also delete associated sale_items due to ON DELETE CASCADE)
DELETE FROM prescriptions WHERE id = 1;