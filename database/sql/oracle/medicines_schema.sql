
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


INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (1, 1, 1, 'Amoxicillin', 'Amoxicillin', 'Moxacil', 'capsule', '500mg', 12, 695, 20, TO_DATE('2027-06-01', 'YYYY-MM-DD'), 'B001', 'Broad spectrum antibiotic', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (2, 1, 2, 'Azithromycin', 'Azithromycin', 'Azithro', 'tablet', '250mg', 35, 348, 15, TO_DATE('2027-08-01', 'YYYY-MM-DD'), 'B002', 'Macrolide antibiotic', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (3, 1, 3, 'Ciprofloxacin', 'Ciprofloxacin', 'Cipro', 'tablet', '500mg', 18, 380, 20, TO_DATE('2026-12-01', 'YYYY-MM-DD'), 'B003', 'Fluoroquinolone antibiotic', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (4, 2, 1, 'Paracetamol', 'Paracetamol', 'Napa', 'tablet', '500mg', 2, 970, 50, TO_DATE('2027-01-01', 'YYYY-MM-DD'), 'B004', 'Fever and pain relief', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (5, 2, 2, 'Ibuprofen', 'Ibuprofen', 'Brufen', 'tablet', '400mg', 8, 299, 30, TO_DATE('2027-03-01', 'YYYY-MM-DD'), 'B005', 'Anti-inflammatory pain reliever', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (6, 2, 4, 'Diclofenac', 'Diclofenac Sodium', 'Voltaren', 'tablet', '50mg', 6.5, 400, 25, TO_DATE('2026-11-01', 'YYYY-MM-DD'), 'B006', 'NSAID for pain and inflammation', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (7, 3, 5, 'Omeprazole', 'Omeprazole', 'Losectil', 'capsule', '20mg', 10, 197, 20, TO_DATE('2027-05-01', 'YYYY-MM-DD'), 'B007', 'Proton pump inhibitor', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (8, 3, 3, 'Antacid Suspension', 'Aluminium Hydroxide', 'Gelusil', 'syrup', '200mg/5ml', 45, 99, 10, TO_DATE('2026-10-01', 'YYYY-MM-DD'), 'B008', 'Liquid antacid', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (9, 4, 2, 'Cetirizine', 'Cetirizine HCl', 'Alatrol', 'tablet', '10mg', 5, 647, 30, TO_DATE('2027-07-01', 'YYYY-MM-DD'), 'B009', 'Non-drowsy antihistamine', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (10, 4, 1, 'Loratadine', 'Loratadine', 'Loratin', 'tablet', '10mg', 6, 196, 20, TO_DATE('2027-04-01', 'YYYY-MM-DD'), 'B010', 'Long-acting antihistamine', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (11, 5, 4, 'Vitamin C', 'Ascorbic Acid', 'C-Vit', 'tablet', '500mg', 3, 700, 50, TO_DATE('2028-01-01', 'YYYY-MM-DD'), 'B011', 'Immune booster vitamin', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (12, 5, 5, 'Vitamin D3', 'Cholecalciferol', 'D-Vit', 'capsule', '1000IU', 15, 280, 20, TO_DATE('2027-09-01', 'YYYY-MM-DD'), 'B012', 'Bone health vitamin', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (13, 6, 1, 'Metformin', 'Metformin HCl', 'Glucophage', 'tablet', '500mg', 9, 210, 25, TO_DATE('2027-02-01', 'YYYY-MM-DD'), 'B013', 'First-line diabetes medicine', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO medicines (id, category_id, supplier_id, name, generic_name, brand, dosage_form, strength, price, stock_quantity, reorder_level, expiry_date, batch_number, description, created_at, updated_at) VALUES (14, 7, 3, 'Amlodipine', 'Amlodipine Besylate', 'Amdocal', 'tablet', '5mg', 7, 380, 20, TO_DATE('2027-06-15', 'YYYY-MM-DD'), 'B014', 'Calcium channel blocker', SYSTIMESTAMP, SYSTIMESTAMP);

-- Read all medicines
SELECT * FROM medicines;
SELECT * FROM medicines WHERE id = 1;
SELECT * FROM medicines WHERE stock_quantity <= reorder_level;  -- low stock

-- Demo update a medicine's price and stock quantity
UPDATE medicines
SET price = 14.00, stock_quantity = 90, updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a medicine (will also delete related purchase_items and sale_items due to foreign key constraints)
DELETE FROM medicines WHERE id = 1;