--active
CREATE TABLE ar_categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE ar_products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  category_id INT NULL,
  FOREIGN KEY (category_id) REFERENCES ar_categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;


--mapper
CREATE TABLE dm_invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer VARCHAR(200),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE dm_invoice_lines (
  id INT AUTO_INCREMENT PRIMARY KEY,
  invoice_id INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  qty INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (invoice_id) REFERENCES dm_invoices(id) ON DELETE CASCADE
) ENGINE=InnoDB;

--gateway
CREATE TABLE tg_suppliers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  contact VARCHAR(200) DEFAULT NULL,
  phone VARCHAR(50) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE tg_reorders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ingredient_id INT NOT NULL,
  quantity DECIMAL(12,3) NOT NULL DEFAULT 0,
  status ENUM('requested','ordered','received','cancelled') NOT NULL DEFAULT 'requested',
  estimated_total DECIMAL(12,2) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  received_at TIMESTAMP NULL DEFAULT NULL,
  note TEXT DEFAULT NULL,
  FOREIGN KEY (ingredient_id) REFERENCES ingredients(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
