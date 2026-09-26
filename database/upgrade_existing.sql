-- Run this once in phpMyAdmin only if you imported an older version of school_canteen.sql.
-- New installations should import school_canteen.sql instead.
USE school_canteen;

ALTER TABLE orders ADD COLUMN IF NOT EXISTS reference_number VARCHAR(80) NULL AFTER supplier_id;
ALTER TABLE deliveries ADD COLUMN IF NOT EXISTS reference_number VARCHAR(80) NULL AFTER order_id;
ALTER TABLE inventory ADD COLUMN IF NOT EXISTS low_stock_threshold DECIMAL(10,2) NOT NULL DEFAULT 10 AFTER unit;

CREATE TABLE IF NOT EXISTS stock_adjustments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  inventory_id INT NOT NULL,
  previous_quantity DECIMAL(10,2) NOT NULL,
  new_quantity DECIMAL(10,2) NOT NULL,
  adjustment_reason VARCHAR(255) NOT NULL,
  adjusted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (inventory_id) REFERENCES inventory(id) ON DELETE CASCADE
) ENGINE=InnoDB;
