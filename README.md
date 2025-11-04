# Sistema de Gestión - CodeIgniter 2

Sistema completo de gestión de usuarios, categorías y productos desarrollado con CodeIgniter v2.

## 📋 Descripción

Este proyecto es un sistema web de gestión que incluye:
- **Autenticación de usuarios** con roles (admin/usuario)
- **Gestión de usuarios** (CRUD completo)
- **Gestión de categorías** (CRUD completo)
- **Gestión de productos/items** (CRUD completo con relación a categorías)

## 🚀 Características

### Módulos Principales

#### 🔐 **Autenticación**
- Login seguro con validación
- Manejo de sesiones
- Roles de usuario (admin/usuario)
- Logout con limpieza de sesión

#### 👥 **Gestión de Usuarios**
- Crear, editar, eliminar usuarios
- Validación de formularios
- Hash de contraseñas con `password_hash()`
- Control de acceso por roles

#### 📂 **Gestión de Categorías**
- CRUD completo de categorías
- Campos: nombre, descripción
- Interfaz intuitiva con Bootstrap
- Validación XSS

#### 📦 **Gestión de Productos**
- CRUD completo de productos
- Campos: nombre, descripción, precio, stock, categoría
- Relación con categorías (foreign key)
- Visualización de stock con colores
- Formularios con validación

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP 7+ con CodeIgniter 2
- **Frontend**: HTML5, CSS3, Bootstrap 5
- **Base de Datos**: MySQL
- **Iconos**: Font Awesome
- **Servidor**: Apache (XAMPP)

## 📁 Estructura del Proyecto

```
test/
├── application/
│   ├── controllers/
│   │   ├── auth.php          # Autenticación
│   │   ├── users.php         # Gestión de usuarios
│   │   ├── categories.php    # Gestión de categorías
│   │   ├── items.php         # Gestión de productos
│   │   └── panel.php         # Panel principal
│   ├── models/
│   │   ├── auth_model.php    # Modelo de autenticación
│   │   ├── users_model.php   # Modelo de usuarios
│   │   ├── categories_model.php # Modelo de categorías
│   │   └── items_model.php   # Modelo de productos
│   ├── views/
│   │   ├── auth/             # Vistas de autenticación
│   │   ├── users/            # Vistas de usuarios
│   │   ├── categories/       # Vistas de categorías
│   │   ├── items/            # Vistas de productos
│   │   ├── panel/            # Vistas del panel
│   │   ├── headers_view.php  # Header común
│   │   └── footer_view.php   # Footer común
│   └── config/
│       ├── autoload.php      # Librerías auto-cargadas
│       ├── config.php        # Configuración principal
│       └── database.php      # Configuración de BD
├── assets/                   # Recursos estáticos
├── system/                   # Core de CodeIgniter
├── database_schema.sql       # Script de base de datos
└── README.md                # Este archivo
```

## 🗄️ Base de Datos

### Tablas Principales

#### `users`
- `id` (PK, AUTO_INCREMENT)
- `name` (VARCHAR 100)
- `email` (VARCHAR 100, UNIQUE)
- `password` (VARCHAR 255, HASH)
- `role` (ENUM: admin, user)
- `status` (ENUM: active, inactive)
- `createdAt` (TIMESTAMP)
- `updatedAt` (TIMESTAMP)

#### `categories`
- `id` (PK, AUTO_INCREMENT)
- `name` (VARCHAR 100, UNIQUE)
- `description` (TEXT)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

#### `items`
- `id` (PK, AUTO_INCREMENT)
- `name` (VARCHAR 150)
- `description` (TEXT)
- `price` (DECIMAL 10,2)
- `stock` (INT)
- `category_id` (FK → categories.id)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

## ⚙️ Instalación

### Prerrequisitos
- XAMPP (Apache + MySQL + PHP 7+)
- Navegador web moderno

### Pasos de Instalación

1. **Clonar/Descargar el proyecto**
   ```bash
   # Colocar en: C:\xampp\htdocs\test\
   ```

2. **Configurar la base de datos**
   - Abrir phpMyAdmin: `http://localhost/phpmyadmin`
   - Crear base de datos: `test_code`
   - Importar: `database_schema.sql`

3. **Configurar CodeIgniter**
   ```php
   // application/config/database.php
   $db['default']['hostname'] = 'localhost';
   $db['default']['username'] = 'root';
   $db['default']['password'] = '';
   $db['default']['database'] = 'test_code';
   ```

4. **Configurar URL base**
   ```php
   // application/config/config.php
   $config['base_url'] = 'http://localhost/test/';
   ```

5. **Iniciar XAMPP**
   - Activar Apache y MySQL
   - Acceder: `http://localhost/test/`

## 🔗 URLs del Sistema

### Principales
- **Inicio**: `http://localhost/test/`
- **Login**: `http://localhost/test/auth/login`
- **Panel**: `http://localhost/test/panel`

### Gestión
- **Usuarios**: `http://localhost/test/users`
- **Categorías**: `http://localhost/test/categories`
- **Productos**: `http://localhost/test/items`
- **Agregar Producto**: `http://localhost/test/items/add`

## 👤 Usuarios por Defecto

El sistema incluye datos de ejemplo. Puedes crear usuarios adicionales desde el panel de administración.

## 🎨 Interfaz de Usuario

- **Diseño**: Bootstrap 5 responsive
- **Iconos**: Font Awesome
- **Colores**: Esquema profesional azul/gris
- **UX**: Formularios intuitivos con validación
- **Feedback**: Mensajes flash para acciones

## 🔒 Seguridad

- **Autenticación**: Sistema de login seguro
- **Autorización**: Control de acceso por roles
- **Validación**: XSS protection con `$this->security->xss_clean()`
- **Contraseñas**: Hash seguro con `password_hash()`
- **Sesiones**: Manejo seguro de sesiones PHP

## 📱 Características Técnicas

### Patrón MVC
- **Modelos**: Lógica de datos y base de datos
- **Vistas**: Presentación con Bootstrap
- **Controladores**: Lógica de negocio

### Funcionalidades
- **CRUD Completo**: Create, Read, Update, Delete
- **Relaciones**: Foreign keys entre tablas
- **Validación**: Formularios con validación client/server
- **Paginación**: Lista de registros paginada
- **Búsqueda**: Filtros en tiempo real
- **Responsive**: Adaptable a móviles

## 🚀 Uso del Sistema

### Para Administradores
1. Login con credenciales de admin
2. Gestionar usuarios desde el panel
3. Crear y organizar categorías
4. Administrar productos e inventario

### Para Usuarios
1. Login con credenciales de usuario
2. Visualizar información según permisos
3. Acceso limitado a funciones administrativas

## 🔧 Desarrollo

### Agregar Nuevos Módulos
1. Crear modelo en `application/models/`
2. Crear controlador en `application/controllers/`
3. Crear vistas en `application/views/`
4. Agregar rutas al menú

### Estructura de Archivos
- Seguir convenciones de CodeIgniter 2
- Usar el patrón establecido en usuarios/categorías/items
- Mantener consistencia en nombres y estructura

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

