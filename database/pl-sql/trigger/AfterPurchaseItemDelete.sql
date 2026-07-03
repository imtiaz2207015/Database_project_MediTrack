CREATE OR REPLACE TRIGGER after_purchase_item_delete
AFTER DELETE ON purchase_items
FOR EACH ROW
BEGIN
    UPDATE medicines
    SET stock_quantity = stock_quantity - :OLD.quantity
    WHERE id = :OLD.medicine_id;
END;
/

ALTER TRIGGER after_purchase_item_delete ENABLE
/
