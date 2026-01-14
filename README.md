# azuFit 🏋️‍♀️

## 📖 Descripción

**AzuFit** es una solución web integral diseñada para centralizar y optimizar la gestión del entrenamiento deportivo en línea. El proyecto nace de la necesidad de unificar herramientas de videoconferencia, gestión de contenidos multimedia y administración de agendas en una única plataforma.
La aplicación emplea una arquitectura **MVC (Modelo-Vista-Controlador)** robusta proporcionada por Laravel permitiendo una separación clara entre la lógica de negocio y la interfaz de usuario. AzuFit ofrece un sistema de acceso restringido donde solo usuarios autenticados pueden visualizar las sesiones de entrenamiento, garantizando así la exclusividad del contenido.

### ✨ Funcionalidades Principales
* **Visualizacion de clases en Youtube o local** 
* **Calendario de Clases privadas** 
* **Roles de Usuario** 

---

## 🛠️ Tecnologías Utilizadas
* **Framework:** Laravel [Versión, 12.4.1]
* **Frontend:** Bootstrap 5
* **Base de Datos:** MySQL 

---

## 📋 Requisitos Previos
* PHP >= 8.3.12
* Composer
* Servidor de Base de Datos (MySQL)

---

## 🚀 Guía de Instalación (Paso a Paso)

Sigue estos pasos para desplegar el proyecto en tu máquina local:

### 1. Clonar el repositorio
git clone
### 2. Instalar dependencias
composer install
### 3. Configurar .env
Copiar .env.example y configurarlo para tu entorno local
### 4. Generar clave de aplicacion
php artisan key:generate
### 5. Base de datos y datos de prueba
Crea la base de datos llamada azufit

php artisan migrate --seed
### 6. Vincular almacenamiento
php artisan storage:link


