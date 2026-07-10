CREATE TABLE categories (
    id NUMBER(19,0) NOT NULL,
    name VARCHAR2(255) NOT NULL,
    description CLOB,
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT categories_id_pk PRIMARY KEY (id)
);


INSERT INTO categories (id, name, description, created_at, updated_at) VALUES (1, 'Antibiotics', 'Medicines that kill or inhibit bacteria', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO categories (id, name, description, created_at, updated_at) VALUES (2, 'Analgesics', 'Pain relieving medicines', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO categories (id, name, description, created_at, updated_at) VALUES (3, 'Antacids', 'Medicines that neutralize stomach acid', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO categories (id, name, description, created_at, updated_at) VALUES (4, 'Antihistamines', 'Medicines for allergic reactions', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO categories (id, name, description, created_at, updated_at) VALUES (5, 'Vitamins', 'Nutritional supplements and vitamins', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO categories (id, name, description, created_at, updated_at) VALUES (6, 'Antidiabetics', 'Medicines to control blood sugar levels', SYSTIMESTAMP, SYSTIMESTAMP);
INSERT INTO categories (id, name, description, created_at, updated_at) VALUES (7, 'Antihypertensive', 'Medicines to lower high blood pressure', SYSTIMESTAMP, SYSTIMESTAMP);

-- Read all categories
SELECT * FROM categories;
SELECT * FROM categories WHERE id = 1;

-- Update a category
UPDATE categories
SET name = 'Painkillers', description = 'Analgesic medicines', updated_at = SYSTIMESTAMP
WHERE id = 1;

--Delete a category
DELETE FROM categories WHERE id = 1;