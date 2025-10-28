-- Script SQL para crear las tablas necesarias
-- Base de datos para el sistema de gestión con CodeIgniter v2

-- Tabla de categorías
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabla de productos/items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_items_category` (`category_id`),
  CONSTRAINT `fk_items_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertar algunas categorías de ejemplo
INSERT INTO `categories` (`name`, `description`) VALUES
('Electrónicos', 'Dispositivos electrónicos y tecnología'),
('Ropa', 'Vestimenta y accesorios'),
('Hogar', 'Artículos para el hogar y decoración'),
('Deportes', 'Equipamiento deportivo y fitness'),
('Libros', 'Literatura y material educativo');

-- Insertar algunos productos de ejemplo
INSERT INTO `items` (`name`, `description`, `price`, `stock`, `category_id`) VALUES
('Smartphone Samsung Galaxy', 'Teléfono inteligente con pantalla de 6.1 pulgadas', 299.99, 25, 1),
('Laptop Dell Inspiron', 'Computadora portátil para uso profesional', 599.99, 10, 1),
('Camiseta Polo', 'Camiseta de algodón 100% en varios colores', 29.99, 50, 2),
('Sofá de 3 plazas', 'Sofá cómodo para sala de estar', 799.99, 5, 3),
('Balón de fútbol', 'Balón oficial FIFA para fútbol profesional', 39.99, 30, 4),
('El Quijote de la Mancha', 'Clásico de la literatura española', 19.99, 100, 5);

-- Verificar que la tabla users existe (debería existir ya)
-- Si no existe, crear la tabla users básica
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
