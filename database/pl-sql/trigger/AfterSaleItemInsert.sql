CREATE OR REPLACE TRIGGER after_sale_item_insert
AFTER INSERT ON sale_items
FOR EACH ROW
BEGIN
    UPDATE medicines
    SET stock_quantity = stock_quantity - :NEW.quantity
    WHERE id = :NEW.medicine_id;
END;
/

ALTER TRIGGER after_sale_item_insert ENABLE
/