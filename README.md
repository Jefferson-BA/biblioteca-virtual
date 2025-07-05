# 📚 Biblioteca Virtual - Laravel + Oracle

Este proyecto implementa un sistema de gestión de biblioteca con autenticación de usuarios, roles (Administrador/Bibliotecario y Usuario), gestión de libros, préstamos, autores y categorías. Toda la lógica de negocio principal está implementada en procedimientos PL/SQL ejecutados desde Laravel.

---

## 🚀 Tecnologías y Herramientas

- ⚙️ **Laravel 12**
- 🐘 **Oracle Database 21c** (conexión vía [Yajra OCI8](https://github.com/yajra/laravel-oci8))
- 💻 **PL/SQL** (procedimientos almacenados)
- 🎨 **Blade** (Laravel Templates)
- 🧩 **Autenticación manual** con roles
- 🗃️ **CSS personalizado** (y/o Bootstrap opcional)
- 🔗 **Composer** y **NPM**
- 📦 **Extensión pdo_oci8** (recomendado: usar Yajra OCI8)

---

## 📦 Requisitos Previos

- **PHP** >= 8.1
- **Composer**
- **Node.js** y **NPM**
- **Oracle Database 21c** o superior
- **Oracle Instant Client 19** o superior ([descargar aquí](https://www.oracle.com/database/technologies/instant-client/downloads.html))
- **Extensión pdo_oci8** habilitada en tu `php.ini`  
  (o instala Yajra OCI8 para Laravel)
- **Laravel CLI**

---

## ⚠️ Configuración de Oracle Instant Client y OCI8

1. **Descarga e instala Oracle Instant Client**  
   [Descargar Oracle Instant Client](https://www.oracle.com/database/technologies/instant-client/downloads.html)

2. **Agrega la carpeta de Instant Client a la variable de entorno `PATH`**  
   Ejemplo:  
   ```
   C:\oracle\instantclient_19_22
   ```

3. **Habilita la extensión OCI8 en tu archivo `php.ini`**  
   Busca y descomenta la línea correspondiente a tu versión:
   ```
   extension=php_oci8_19.dll  ; Use with Oracle Database 19c Instant Client
   ```
   o
   ```
   extension=php_oci8_12c.dll ; Use with Oracle Database 12c Instant Client
   ```

4. **Reinicia Apache o tu servidor web** para aplicar los cambios.

5. **Verifica que la extensión está activa**  
   Ejecuta en terminal:
   ```
   php -m | findstr oci
   ```
   Debes ver `oci8` en la lista.

---

## 🔧 Instalación y Ejecución

### 1. Clona el repositorio

```bash
git clone https://github.com/Jefferson-BA/biblioteca-virtual.git
cd biblioteca-virtual
```

### 2. Instala dependencias PHP y JS

```bash
composer install
npm install && npm run build
```

### 3. Instala el paquete Yajra OCI8 para Oracle (si no lo tienes)

```bash
composer require yajra/laravel-oci8:"^10"
```

### 4. Configura el entorno `.env`

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

### 5. Configura el proveedor Yajra (si aplica)

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

### 6. Crea las tablas y procedimientos en Oracle

Ejecuta el script SQL proporcionado en la carpeta `/database` o el que te compartió el equipo para crear tablas, vistas y procedimientos PL/SQL.  
**Asegúrate de ejecutar todos los procedimientos y vistas antes de iniciar la aplicación.**

### 7. Corre el servidor

```bash
php artisan serve
```

Accede desde: [http://localhost:8000](http://localhost:8000)

---

## 👥 Cuentas de Prueba

| Rol           | Email               | Contraseña   |
|---------------|---------------------|--------------|
| Bibliotecario | admin@gmail.com     | 123          |
| Usuario       | usuario@gmail.com   | 123          |

---

## 📦 Estructura de módulos principales

- **Gestión de Libros:** CRUD de libros, categorías y autores.
- **Gestión de Préstamos:** Solicitud y devolución de libros, historial de préstamos.
- **Gestión de Usuarios:** Registro, autenticación y roles (usuario/bibliotecario).
- **Reportes:** (opcional) Libros más prestados, préstamos vencidos (solo bibliotecario).

---

## ⚠️ Notas Especiales

- Este proyecto hace uso de **procedimientos PL/SQL** para registrar, actualizar y eliminar usuarios, libros y préstamos.
- Asegúrate de ejecutar los scripts SQL en Oracle antes de usar la aplicación.
- El usuario de Oracle debe tener privilegios sobre el tablespace `USERS`.
- Si usas Yajra OCI8, revisa la [documentación oficial](https://github.com/yajra/laravel-oci8) para detalles de instalación.
- Si usas imágenes personalizadas, colócalas en la carpeta `public/images/`.

---

## 📝 Autor

Desarrollado por Jefferson Bautista Aguilera – Perú 🇵🇪  
Repositorio GitHub: [https://github.com/Jefferson-BA/biblioteca-virtual](https://github.com/Jefferson-BA/biblioteca-virtual)

---

## ✅ Estado del Proyecto

📌 Proyecto funcional, completo para entrega académica.  
✔️ Roles, autenticación, procedimientos PL/SQL, CRUDs y estilos diferenciados para usuario y bibliotecario.

---

## 📄 Licencia

Este proyecto está bajo la licencia MIT.