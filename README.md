# Inventario de Motos

Sistema de gestión de inventario de motocicletas desarrollado en PHP con MySQL.

## Desarrollador
**Sebastian Ibarra**

## Características

- 🏍️ Gestión completa de inventario de motos
- 📊 Panel de administración con estadísticas
- 🎨 Diseño moderno con tema naranja/gris oscuro
- 🔐 Sistema de autenticación
- 📱 Diseño responsivo
- ✨ Interfaz intuitiva y profesional

## Tecnologías Utilizadas

- PHP 8.x
- MySQL/MariaDB
- HTML5
- CSS3 (Custom Design System)
- PDO para conexión a base de datos

## Instalación

### Requisitos Previos
- XAMPP (o similar con PHP y MySQL)
- Navegador web moderno

### Pasos de Instalación

1. **Copiar el proyecto**
   - Coloca la carpeta `inventario_motos` en `c:\xampp\htdocs\`

2. **Configurar la base de datos**
   - Abre phpMyAdmin: `http://localhost/phpmyadmin`
   - Importa el archivo `database_setup.sql`
   - Esto creará la base de datos `inventario_motos_db` con datos de ejemplo

3. **Iniciar el servidor**
   - Inicia Apache y MySQL desde el panel de control de XAMPP

4. **Acceder al sistema**
   - Página principal: `http://localhost/taller-de-motos/`
   - Panel de administración: `http://localhost/taller-de-motos/auth/login.php`

## Credenciales de Acceso

- **Usuario:** admin
- **Contraseña:** admin

## Estructura del Proyecto

```
taller-de-motos/
├── admin/
│   ├── categorias/
│   │   ├── listar.php
│   │   ├── crear.php
│   │   ├── editar.php
│   │   └── eliminar.php
│   ├── productos/
│   │   ├── listar.php
│   │   ├── crear.php
│   │   ├── editar.php
│   │   └── eliminar.php
│   └── index.php
├── assets/
│   └── css/
│       └── estilos.css
├── auth/
│   ├── login.php
│   ├── validar_login.php
│   └── logout.php
├── config/
│   └── db.php
├── includes/
│   └── footer.php
├── database_setup.sql
├── index.php
├── productos.php
└── README.md
```

## Funcionalidades

### Panel Público
- Visualización de catálogo de motos
- Filtrado por categorías
- Información detallada de cada moto (cilindrada, color, precio, stock)

### Panel de Administración
- **Dashboard:** Estadísticas generales del inventario
- **Gestión de Categorías:** Crear, editar, eliminar categorías de motos
- **Gestión de Motos:** CRUD completo de motocicletas
  - Nombre
  - Cilindrada (ej: 250cc, 1000cc)
  - Color
  - Precio
  - Stock
  - Categoría
  - Imagen

## Categorías de Motos Incluidas

1. Deportivas
2. Cruiser
3. Touring
4. Off-Road
5. Scooter

## Diseño y Estilo

El sistema cuenta con un diseño moderno y profesional con las siguientes características:

- **Paleta de colores:** Naranja vibrante (#ff6b35) y gris oscuro (#2d3142)
- **Tipografía:** Roboto (Google Fonts)
- **Botones:** Estilo pill con sombras pronunciadas
- **Tarjetas:** Bordes oscuros y sombras destacadas
- **Layout:** Diseño vertical para tarjetas del dashboard
- **Formularios:** Disposición de una sola columna

## Diferencias con el Proyecto Original

Este proyecto está basado en `almacen_ropa` pero con las siguientes modificaciones:

1. **Tema de color:** Naranja/gris oscuro (vs. Indigo/ámbar)
2. **Campo específico:** Cilindrada (vs. Talla)
3. **Categorías:** Tipos de motos (vs. Ropa)
4. **Layout:** Botones alineados a la derecha en hero
5. **Dashboard:** Tarjetas en disposición vertical
6. **Formularios:** Layout de una sola columna
7. **Créditos:** Sebastian Ibarra

## Soporte

Para soporte o consultas, contactar al desarrollador Sebastian Ibarra.

## Licencia

© 2025 Inventario de Motos. Todos los derechos reservados.
Desarrollado por Sebastian Ibarra.
