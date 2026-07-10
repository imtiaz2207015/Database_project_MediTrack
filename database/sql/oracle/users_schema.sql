CREATE TABLE users (
    id NUMBER(19,0) NOT NULL,
    name VARCHAR2(255) NOT NULL,
    email VARCHAR2(255) NOT NULL,
    email_verified_at TIMESTAMP(6),
    password VARCHAR2(255) NOT NULL,
    remember_token VARCHAR2(100),
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),
    role VARCHAR2(255) DEFAULT 'Pharmacist' NOT NULL,

    CONSTRAINT users_id_pk PRIMARY KEY (id),
    CONSTRAINT users_email_uk UNIQUE (email)
);


INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) VALUES (1, 'Admin User', 'admin@meditrack.com', SYSTIMESTAMP, '$2y$12$kkQiuDaZfhD.0zspDcMuOu9UjNiPU/MrZZpqsROWRtEb47pvHu6hK', NULL, SYSTIMESTAMP, SYSTIMESTAMP, 'Pharmacist');
INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) VALUES (2, 'Rahim Uddin', 'rahim@meditrack.com', SYSTIMESTAMP, '$2y$12$NHXDsf4Tnvbh48F6VuRxxOFw55BGHszoB9Uthelo.YYWLkFecoOkm', NULL, SYSTIMESTAMP, SYSTIMESTAMP, 'Pharmacist');
INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) VALUES (3, 'Salma Begum', 'salma@meditrack.com', SYSTIMESTAMP, '$2y$12$tnjNrjyVTcD94Aka3xoQ1OkUk.aRNJFxxI6mW1vRaWIBL8Udizvqi', NULL, SYSTIMESTAMP, SYSTIMESTAMP, 'Pharmacist');
INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) VALUES (21, 'Nadia Imtiaz', 'nadia@gmail.com', SYSTIMESTAMP, '$2y$12$Ie9c9OTs.WHdQxTaIb4KcO.tw461QpiC0OKanVYh5BJAfpH6EIrQm', NULL, SYSTIMESTAMP, SYSTIMESTAMP, 'Pharmacist');
INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) VALUES (41, 'Shehreen', 'shehreen@gmail.com', SYSTIMESTAMP, '$2y$12$DwHXjXYci9YSkBDRHDUYeuQu/7jJOeywzujt0z1FNx8qBFceCTE/K', NULL, SYSTIMESTAMP, SYSTIMESTAMP, 'Pharmacist');


SELECT * FROM users;
SELECT * FROM users WHERE id = 1;

-- demo update
UPDATE users
SET role = 'Admin', updated_at = SYSTIMESTAMP
WHERE id = 1;

-- Delete a user
DELETE FROM users WHERE id = 1;