
CREATE TABLE stock_adjustments (
    id NUMBER(19,0) NOT NULL,
    medicine_id NUMBER(19,0) NOT NULL,
    user_id NUMBER(19,0) NOT NULL,
    type VARCHAR2(255) NOT NULL,
    quantity NUMBER(10,0) NOT NULL,
    reason VARCHAR2(255),
    created_at TIMESTAMP(6),
    updated_at TIMESTAMP(6),

    CONSTRAINT chk_type CHECK (type in ('increase', 'decrease')),
    CONSTRAINT stock_adjustments_id_pk PRIMARY KEY (id),
    CONSTRAINT stoc_adjustment_medicin_id_fk FOREIGN KEY (medicine_id) REFERENCES medicines (id) ON DELETE CASCADE,
    CONSTRAINT stock_adjustments_user_id_fk FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);