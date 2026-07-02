CREATE OR REPLACE TRIGGER after_sale_item_delete
AFTER DELETE ON sale_items
FOR EACH ROW
BEGIN
    UPDATE medicines
    SET stock_quantity = stock_quantity + :OLD.quantity
    WHERE id = :OLD.medicine_id;
END;
/

ALTER TRIGGER after_sale_item_delete ENABLE
/