# azuFit 🏋️‍♀️

## 📖 Descripción
Plataforma de entrenamiento deportivo

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
### 4. Generar clave de aplicacion
php artisan key:generate
### 5. Base de datos y datos de prueba
php artisan migrate --seed
### 6. Vincular almacenamiento
php artisan storage:link

Puedes usar admin@azufit.com + contraseña 0000 para acceder como admin y usar todas las funcionalidades
