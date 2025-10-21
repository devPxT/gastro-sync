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


CREATE DATABASE gastro;
USE gastro;

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

-- permissions + roles + mapping + users_roles (assume users já existe)
CREATE TABLE IF NOT EXISTS permissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(100) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  description TEXT
);

CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS role_permissions (
  role_id INT NOT NULL,
  permission_id INT NOT NULL,
  PRIMARY KEY(role_id, permission_id),
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
  FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS users_roles (
  user_id INT NOT NULL,
  role_id INT NOT NULL,
  PRIMARY KEY(user_id, role_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);


INSERT IGNORE INTO permissions (code, name, description) VALUES
('home.view','Ver Home','Acessar a Home'),
('cadastros.view','Ver Cadastros','Acessar a seção Cadastros'),
('cardapio.view','Ver Cardápio','Acessar Cardápio'),
('estacoes.view','Ver Estações','Acessar Estações'),
('estoque.view','Ver Estoque','Acessar Estoque'),
('faturamento.view','Ver Faturamento','Acessar Faturamento'),
('relatorios.view','Ver Relatórios','Acessar Relatórios');

INSERT IGNORE INTO roles (name) VALUES
('Admin'),('Caixa'),('Estoque'),('Garçom'),('Cozinheiro');

-- map roles -> permissions (example)
-- Admin: all permissions
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r CROSS JOIN permissions p WHERE r.name='Admin'
ON DUPLICATE KEY UPDATE role_id=role_id;

-- Caixa: home, cardapio, faturamento
INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r JOIN permissions p ON p.code IN ('home.view','cardapio.view','faturamento.view') WHERE r.name='Caixa';

-- Estoque: home, estoque
INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r JOIN permissions p ON p.code IN ('home.view','estoque.view') WHERE r.name='Estoque';

-- Garçom: home, cardapio
INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r JOIN permissions p ON p.code IN ('home.view','cardapio.view') WHERE r.name='Garçom';

-- Cozinheiro: home, estacoes
INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id FROM roles r JOIN permissions p ON p.code IN ('home.view','estacoes.view') WHERE r.name='Cozinheiro';

-- Example: assign a role to a user (assumes user id=1 exists)
INSERT IGNORE INTO users_roles (user_id, role_id) SELECT 1, id FROM roles WHERE name='Admin';
