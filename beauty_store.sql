-- Base de datos Beauty Store (tienda de maquillaje)
CREATE DATABASE IF NOT EXISTS beauty_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE beauty_store;

-- Reinicio limpio: elimina las tablas si ya existían (no usa DROP DATABASE)
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS detalle_pedido, pedidos, clientes, productos, proveedores, marcas, categorias, usuarios, tipos_usuarios;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE tipos_usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL UNIQUE,
  descripcion VARCHAR(150) NULL
) ENGINE=InnoDB;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefono VARCHAR(30) NULL,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  clave VARCHAR(255) NOT NULL,
  tipo_usuario_id INT NOT NULL,
  FOREIGN KEY (tipo_usuario_id) REFERENCES tipos_usuarios(id)
) ENGINE=InnoDB;

CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  descripcion VARCHAR(200) NULL
) ENGINE=InnoDB;

CREATE TABLE marcas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  pais VARCHAR(60) NULL
) ENGINE=InnoDB;

CREATE TABLE proveedores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NULL,
  telefono VARCHAR(30) NULL,
  direccion VARCHAR(150) NULL
) ENGINE=InnoDB;

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  descripcion TEXT NULL,
  precio DECIMAL(10,2) NOT NULL DEFAULT 0,
  stock INT NOT NULL DEFAULT 0,
  categoria_id INT NOT NULL,
  marca_id INT NOT NULL,
  proveedor_id INT NOT NULL,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id),
  FOREIGN KEY (marca_id) REFERENCES marcas(id),
  FOREIGN KEY (proveedor_id) REFERENCES proveedores(id)
) ENGINE=InnoDB;

CREATE TABLE clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NULL,
  telefono VARCHAR(30) NULL,
  direccion VARCHAR(150) NULL
) ENGINE=InnoDB;

CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT NOT NULL,
  fecha DATE NOT NULL,
  estado ENUM('Pendiente','Pagado','Enviado','Entregado','Cancelado') NOT NULL DEFAULT 'Pendiente',
  total DECIMAL(10,2) NOT NULL DEFAULT 0,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id)
) ENGINE=InnoDB;

CREATE TABLE detalle_pedido (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NOT NULL,
  producto_id INT NOT NULL,
  cantidad INT NOT NULL DEFAULT 1,
  precio_unitario DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
  FOREIGN KEY (producto_id) REFERENCES productos(id)
) ENGINE=InnoDB;

-- Datos iniciales
INSERT INTO tipos_usuarios (nombre, descripcion) VALUES
 ('Administrador','Acceso total al sistema'),
 ('Vendedor','Gestiona productos, clientes y pedidos');

-- Usuario: admin  |  Clave inicial: password  (cambiarla desde el CRUD de usuarios)
INSERT INTO usuarios (nombre,email,telefono,usuario,clave,tipo_usuario_id) VALUES
 ('Administrador','admin@beautystore.com','','admin','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',1);

INSERT INTO categorias (nombre,descripcion) VALUES ('Labiales','Labiales y brillos'),('Rostro','Bases, correctores y polvos'),('Ojos','Sombras, delineadores y máscaras');
INSERT INTO marcas (nombre,pais) VALUES ('Maybelline','Estados Unidos'),('L''Oréal','Francia');
INSERT INTO proveedores (nombre,email,telefono,direccion) VALUES ('Distribuidora Glam','ventas@glam.com','3510000000','Av. Colón 100');
INSERT INTO productos (nombre,descripcion,precio,stock,categoria_id,marca_id,proveedor_id) VALUES
 ('Labial Mate Rojo','Larga duración',4500.00,30,1,1,1),
 ('Base Líquida 24h','Cobertura media',8900.00,15,2,2,1);
INSERT INTO clientes (nombre,email,telefono,direccion) VALUES ('María Pérez','maria@mail.com','3511111111','Córdoba');
INSERT INTO pedidos (cliente_id,fecha,estado,total) VALUES (1,CURDATE(),'Pendiente',13400.00);
INSERT INTO detalle_pedido (pedido_id,producto_id,cantidad,precio_unitario) VALUES (1,1,1,4500.00),(1,2,1,8900.00);
