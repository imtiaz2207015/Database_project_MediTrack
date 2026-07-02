CREATE OR REPLACE TRIGGER after_purchase_item_insert
AFTER INSERT ON purchase_items
FOR EACH ROW
BEGIN
    UPDATE medicines
    SET stock_quantity = stock_quantity + :NEW.quantity
    WHERE id = :NEW.medicine_id;
END;
/

ALTER TRIGGER after_purchase_item_insert ENABLE
/