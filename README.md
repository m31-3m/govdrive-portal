# 🏛️ GovDrive: Modern Digital Secretariat Portal

**WAD 2 Final Project: Laravel Application**\
**Submitted By:** \[Lorein Manluctao\] & \[Mel Magdaraog\]
**Submitted To:** \[Mr. Jehu Casimiro\]

------------------------------------------------------------------------

## 📌 Project Overview

GovDrive is a high-fidelity government service web application built with **Laravel 11**, **Tailwind CSS**, and **Alpine.js**.

The system allows citizens to securely request official documents (Birth Certificates, Business Permits, etc.) and upload supporting files.
Simultaneously, it provides government officials with an administrative dashboard to audit, approve, or reject submissions in real-time.

We focused on modern UI/UX design while strictly adhering to secure backend practices (Role-Based Access Control, Policies, and Eloquent relationships).

------------------------------------------------------------------------

## 🚀 Implemented Features & Rubric Compliance

### 1. Complete CRUD Operations

-   Create, Read, Update, Delete for service requests

### 2. Authentication

-   Laravel Breeze authentication system

### 3. Middleware

-   Protected routes using auth middleware

### 4. Authorization

-   Policies and Gates for RBAC

### 5. Eloquent Relationships

-   One-to-Many: User ↔ ServiceRequest

------------------------------------------------------------------------

## 🔑 Demo Credentials

  Role    Email              Password
  ------- ------------------ --------------
  Admin   admin@gov.ph       password123
  User    juan@citizen.com   password123

------------------------------------------------------------------------

## 💻 Installation

``` bash
git clone https://github.com/m31-3m/govdrive-portal.git

cd [YOUR_REPO_NAME]

composer install

npm install

cp .env.example .env

php artisan key:generate

touch database/database.sqlite

php artisan migrate:fresh --seed

php artisan storage:link

npm run build

php artisan serve
```

------------------------------------------------------------------------

## 🌐 Access

http://127.0.0.1:8000