# 📚 Biblioteca Virtual - Laravel + Oracle

Este proyecto implementa un sistema de gestión de biblioteca con autenticación de usuarios, roles (Administrador/Bibliotecario y Usuario), gestión de libros, préstamos, autores y categorías. Incluye procedimientos PL/SQL ejecutados desde Laravel.

---

## 🚀 Tecnologías y Herramientas

- ⚙️ **Laravel 12**
- 🐘 **Oracle Database** (conexión vía [Yajra OCI8](https://github.com/yajra/laravel-oci8))
- 💻 **PL/SQL** (procedimientos almacenados)
- 🎨 **Blade** (Laravel Templates)
- 🧩 **Autenticación manual** con roles
- 🗃️ **Bootstrap** y/o **CSS personalizado**
- 🔗 **Composer** y **NPM**
- 📦 **Extensión pdo_oci8** (recomendado: usar Yajra OCI8)

---

## 📦 Requisitos Previos

- PHP >= 8.1
- Composer
- Node.js y NPM
- Oracle Database 21c o superior
- Extensión `pdo_oci8` (o Yajra OCI8)
- Laravel CLI

---

## 🔧 Instalación

1. **Clona el repositorio**

   ```bash
   git clone https://github.com/Jefferson-BA/biblioteca-virtual.git
   cd BibliotecaVirtual-Oracle
   ```

2. **Instala dependencias PHP y JS**

   ```bash
   composer install
   npm install && npm run build
   ```

3. **Configura el entorno `.env`**

   Copia el archivo de ejemplo y configura tu conexión a Oracle:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   En el `.env`:

   ```
   DB_CONNECTION=oracle
   DB_HOST=localhost
   DB_PORT=1521
   DB_DATABASE=xe
   DB_USERNAME=USER03
   DB_PASSWORD=tu_password
   ```

4. **Configura el proveedor Yajra (si aplica)**

   Asegúrate de tener en tu `config/database.php` la conexión a Oracle definida como:

   ```php
   'oracle' => [
       'driver'         => 'oracle',
       'tns'            => '',
       'host'           => env('DB_HOST', 'localhost'),
       'port'           => env('DB_PORT', '1521'),
       'database'       => env('DB_DATABASE', 'xe'),
       'username'       => env('DB_USERNAME', 'USER03'),
       'password'       => env('DB_PASSWORD', ''),
       'charset'        => 'AL32UTF8',
       'prefix'         => '',
       'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
   ],
   ```

5. **Crea las tablas y procedimientos en Oracle**

   Ejecuta el script SQL proporcionado en la carpeta `/database` o el que te compartió el equipo para crear tablas, vistas y procedimientos PL/SQL.

6. **Corre el servidor**

   ```bash
   php artisan serve
   ```

   Accede desde: [http://localhost:8000](http://localhost:8000)

---

## 👥 Cuentas de Prueba

| Rol           | Email               | Contraseña   |
|---------------|---------------------|--------------|
| Bibliotecario | admin@gmail.com     | 123    |
| Usuario       | usuario@gmail.com   | 123   |

---

## ⚠️ Notas Especiales

- Este proyecto hace uso de **procedimientos PL/SQL** para registrar, actualizar y eliminar usuarios, libros y préstamos.
- Asegúrate de ejecutar los scripts SQL en Oracle antes de usar la aplicación.
- El usuario de Oracle debe tener privilegios sobre el tablespace `USERS`.
- Si usas Yajra OCI8, revisa la [documentación oficial](https://github.com/yajra/laravel-oci8) para detalles de instalación.

---

## 📝 Autor

Desarrollado por Jefferson Bautista Aguilera – Perú 🇵🇪  
Repositorio GitHub: [https://github.com/Jefferson-BA/biblioteca-virtual?tab=readme-ov-file](https://github.com/Jefferson-BA/BibliotecaVirtual-Oracle)

---

## ✅ Estado del Proyecto

📌 Proyecto funcional, completo para entrega académica.  
✔️ Roles, autenticación, procedimientos PL/SQL, CRUDs y estilos diferenciados para usuario y bibliotecario.

---

## 📄 Licencia

Este proyecto está bajo la licencia MIT.