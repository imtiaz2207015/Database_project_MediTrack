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



