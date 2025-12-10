# Integrantes del Equipo: 
-Axel Saucedo Palos.			
-Edson Abraham Martínez Herrera.	
-Saul Vásquez Ávila.			
-Omar Andrea Herrera.			
-Ailyn Hernández Hermosillo.		
-Yosef Yael Duron Cervantes.	


# QRINVENTORY — Sistema de Gestión de Inventario con Códigos QR

QRINVENTORY es un sistema moderno y eficiente para el control de inventarios mediante la generación, consulta y escaneo de **códigos QR**, permitiendo una administración rápida, segura y precisa de productos dentro de un almacén, empresa o institución.

Este proyecto fue desarrollado como una solución integral para el registro, clasificación, rastreo y auditoría de artículos en tiempo real.

---

## ¿De qué trata el proyecto?

QRINVENTORY es una plataforma web enfocada en facilitar la gestión de inventarios mediante:

- Registro, edición y eliminación de productos.
- Clasificación por categorías.
- Generación automática de **códigos QR únicos** por producto.
- Escaneo de códigos desde la cámara del dispositivo.
- Registro de **movimientos de inventario** (entradas y salidas).
- Dashboard con estadísticas e indicadores clave.
- Exportación de reportes a **PDF** y **Excel**.
- Administración de usuarios y roles (Administrador / Usuario).
- Catálogo visual del inventario y vista rápida.

---

## Tecnologías Utilizadas

### Backend
- Laravel 10
- PHP 8.1+
- Eloquent ORM
- Middleware `auth`, `verified`, `admin`

### Frontend
- Blade Templates
- Vite
- TailwindCSS / CSS

### 🗄 Base de Datos
- MySQL / MariaDB
- Migraciones y Seeders

### Integración QR
- Librerías para generación de códigos QR
- Escaneo desde cámara del dispositivo

---

## Características principales del sistema

- CRUD completo de productos.
- Generación y descarga de códigos QR en PNG.
- Escaneo y consulta rápida por SKU o QR.
- Registro de entradas y salidas del inventario.
- Dashboard con:
  - Total de productos
  - Total de categorías
  - Productos con bajo stock
  - Movimientos del día
  - Últimos movimientos registrados
- Reportes PDF y Excel.
- Administración de usuarios.
- Diseño responsivo y moderno.
- Catálogo visual del inventario.

---

##  Instalación y Configuración

###  Clonar repositorio
git clone https://github.com/usuario/QRINVENTORY.git

### Instalar dependencias
composer install
npm install

### Configurar archivo .env
cp .env.example .env  
php artisan key:generate

### Ejecutar migraciones y seeders
php artisan migrate --seed

### Iniciar servidores
npm run dev  
php artisan serve


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
