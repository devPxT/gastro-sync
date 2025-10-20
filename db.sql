-- tabelas necessarias para observer funcionar

-- tabela de ingredientes (estoque)
CREATE TABLE IF NOT EXISTS ingredients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  quantity DECIMAL(10,3) NOT NULL DEFAULT 0, -- quantidade em unidade definida
  unit VARCHAR(20) DEFAULT 'un',
  threshold DECIMAL(10,3) NOT NULL DEFAULT 5, -- nível mínimo para alerta
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- tabela de "receitas" que relaciona menu_item -> ingredient -> quantidade por porção
CREATE TABLE IF NOT EXISTS recipes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  menu_item_id INT NOT NULL, -- id do menu_items
  ingredient_id INT NOT NULL,
  qty_per_serving DECIMAL(10,3) NOT NULL, -- quantidade de ingrediente por 1 unidade do menu item
  FOREIGN KEY (ingredient_id) REFERENCES ingredients(id) ON DELETE CASCADE
);

-- tabela de reordenamento automático (exemplo)
CREATE TABLE IF NOT EXISTS reorders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ingredient_id INT NOT NULL,
  quantity DECIMAL(10,3) NOT NULL,
  status VARCHAR(50) DEFAULT 'requested',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (ingredient_id) REFERENCES ingredients(id) ON DELETE CASCADE
);


CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  login VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);
insert into users (login, password) values ('teste', '123');

CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  level VARCHAR(50) NOT NULL,
  message TEXT NOT NULL,
  context JSON DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);