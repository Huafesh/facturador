# 📂 Facturador PHP - Sistema de Boletas y Facturas

Un sistema completo de facturación electrónica y gestión de boletas de venta, desarrollado en PHP y MySQL. Cuenta con control de usuarios (inicio de sesión/registro), edición de boletas y exportación a archivos PDF.

---

## 🚀 Características Principales

* Sistema de autenticación completo (registro, login, logout con sesiones PHP).
* Gestión CRUD para boletas de venta (crear, editar, eliminar).
* Generador de PDF integrado (`generar_pdf.php`) para impresión y descargas de boletas.
* Conexión estructurada a base de datos relacional MySQL.

---

## 🛠️ Tecnologías Utilizadas

* PHP (Native)
* MySQL (PDO/mysqli)
* HTML5 / CSS3 (estilos personalizados)
* PDF Generation Libraries (FPDF/TCPDF)

---

### Configuración e Instalación

1. Mueve el proyecto a tu servidor local de PHP (ej. la carpeta `htdocs` de XAMPP).
2. Importa el archivo de base de datos MySQL (revisa las credenciales en `conexion.php` y configúralas según tu servidor local).
3. Inicia Apache y MySQL desde tu panel de control.
4. Ingresa a `http://localhost/facturador` e inicia sesión.

---
*Este repositorio ha sido configurado y catalogado automáticamente.*
