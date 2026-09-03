# SmartClinic

A clinic management web application built with Laravel and MySQL. The system manages patients, doctors, appointments, schedules, medicines, prescriptions, departments, and role-based access to administrative modules.

**GitHub:** https://github.com/hieusnguyen0709/SmartClinic

---

## Table of Contents

- [Tech Stack](#tech-stack)
- [Architecture](#architecture)
- [Core Features](#core-features)
- [Getting Started](#getting-started)
- [Environment Variables](#environment-variables)
- [Available Scripts](#available-scripts)
- [Authentication & Authorization](#authentication--authorization)
- [Database Design](#database-design)
- [Project Structure](#project-structure)

---

## Tech Stack

| Category | Technology |
|---|---|
| Language | PHP 7.3+ / PHP 8.x |
| Framework | Laravel 8 |
| Database | MySQL |
| ORM | Laravel Eloquent |
| Authentication | Laravel Authentication, Laravel Sanctum |
| Authorization | Custom middleware, role-based permissions |
| Validation | Laravel Validator |
| Frontend | Blade, JavaScript, Axios |
| CSS / Assets | CSS, Laravel Mix |
| Dependency Management | Composer, npm |

Laravel 8 is the main application framework, while Eloquent is used for database access and relationships. The project also uses a Repository layer to separate data-access operations from controllers. citeturn2view0turn2view1

## Architecture

The application follows a layered MVC-style architecture with repositories and selected service classes:

```text
Route
  ↓
Middleware (Authentication / Admin Access / Permission)
  ↓
Controller
  ↓
Service / Repository
  ↓
Eloquent Model
  ↓
MySQL
```

- **Route**: defines authentication, public frontend, and administrative endpoints.
- **Middleware**: protects authenticated/admin routes and checks module permissions before allowing access.
- **Controller**: handles HTTP requests, validation, view rendering, and delegates database operations to repositories or services.
- **Service**: contains reusable application logic where a workflow involves multiple operations. For example, `ScheduleService` prepares schedule data for list and calendar views.
- **Repository**: centralizes common database queries and CRUD operations for application modules.
- **Model**: represents database entities and defines Eloquent relationships.
- **Database**: MySQL stores users, roles, appointments, schedules, medicines, prescriptions, departments, and related entities.

The repository structure includes module-specific repositories such as Appointment, CaseHistory, Category, Department, Frame, Medicine, Prescription, Schedule, and User, together with shared `BaseRepository` and `RepositoryInterface` abstractions. citeturn4view2

---

## Core Features

### User & Role Management

- User registration and login.
- User management for administrative users.
- Account status management.
- Role management.
- Permission-based access to administrative modules.

### Role-Based Access Control

The system defines five application roles:

- **Admin**
- **Doctor**
- **Patient**
- **Receptionist**
- **Pharmacist**

Each role receives a predefined set of permissions. Permissions are defined for operations such as viewing, creating, editing, deleting, and locking records across users, roles, medicines, prescriptions, schedules, frames, and appointments. citeturn7view2

### Appointment Management

- Create and manage patient appointments.
- Assign appointments to doctors.
- Track appointment status.
- Associate appointments with patients and doctors.
- Query appointments by relevant scheduling information.

The `Appointment` model explicitly relates an appointment to both a patient and a doctor through Eloquent relationships. citeturn6view2

### Doctor Schedule Management

- Create and update doctor schedules.
- Assign time frames to doctors.
- Filter schedules by doctor and date range.
- Display schedules in a calendar view.
- Update schedule dates directly from the calendar.

`ScheduleService` converts schedule data into structures used by the list and calendar views, while `ScheduleFrameRepository` handles the relationship between schedules and time frames. citeturn8view1turn6view3

### Medicine & Prescription Management

- Manage medicine categories.
- Manage medicine inventory and quantities.
- Create and update prescriptions.
- Associate prescriptions with patients and doctors.
- Add multiple medicines to a prescription.
- Validate requested medicine quantities.
- Decrease medicine inventory when medicines are assigned to a prescription.

Prescription processing coordinates prescription records, prescription-medicine records, and medicine inventory updates. The medicine transaction is wrapped in a database transaction so related inventory changes can be rolled back when an exception occurs. citeturn8view0

### Other Administrative Modules

- Departments
- Time frames
- QR codes
- Medical case history
- Dashboard

The administrative routes expose dedicated modules for appointments, case history, departments, frames, QR codes, schedules, users, roles, categories, medicines, and prescriptions. citeturn7view0

---

## Getting Started

### Prerequisites

- PHP 7.3+ (PHP 8.x supported by the project's Composer constraint)
- Composer
- Node.js and npm
- MySQL

The project is based on Laravel 8.75 and declares PHP `^7.3|^8.0` in `composer.json`. citeturn2view0

### Installation

Clone the repository:

```bash
git clone https://github.com/hieusnguyen0709/SmartClinic.git

cd SmartClinic
```

Install PHP dependencies:

```bash
composer install
```

Install frontend/build dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

Configure the MySQL connection in `.env`, then run the database migrations and seeders:

```bash
php artisan migrate
php artisan db:seed
```

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## Environment Variables

The project uses Laravel's `.env` configuration for application and database settings. The provided `.env.example` includes the following main variables: citeturn3view0

| Variable | Description |
|---|---|
| `APP_NAME` | Application name |
| `APP_ENV` | Application environment |
| `APP_KEY` | Laravel application encryption key |
| `APP_DEBUG` | Enables/disables debug mode |
| `APP_URL` | Application base URL |
| `DB_CONNECTION` | Database driver (`mysql`) |
| `DB_HOST` | MySQL host |
| `DB_PORT` | MySQL port |
| `DB_DATABASE` | Application database name |
| `DB_USERNAME` | MySQL username |
| `DB_PASSWORD` | MySQL password |
| `MAIL_*` | Mail server configuration |
| `AWS_*` | Optional AWS filesystem configuration |
| `PUSHER_*` | Optional real-time broadcasting configuration |

Do not commit a production `.env` file or real credentials to the repository.

---

## Available Scripts

### Laravel / PHP

```bash
php artisan serve
php artisan migrate
php artisan db:seed
php artisan key:generate
```

### Frontend assets

| Command | Description |
|---|---|
| `npm run dev` | Compile frontend assets for development |
| `npm run watch` | Watch frontend assets and recompile on changes |
| `npm run watch-poll` | Watch frontend assets using polling |
| `npm run hot` | Run Laravel Mix in hot-reload mode |
| `npm run production` | Build production frontend assets |
| `npm run prod` | Alias for the production build |

These commands are defined by the project's `package.json` and Laravel Mix configuration. citeturn2view1

---

## Authentication & Authorization

Authentication uses Laravel's session-based authentication flow.

The login flow validates the submitted credentials and uses Laravel's `Auth::attempt()` to authenticate the user. Patients are redirected to the public frontend after login, while other authorized roles are redirected to the administrative dashboard. citeturn8view2

Administrative routes are protected by three middleware layers:

```text
auth
  ↓
admin.access
  ↓
permission
```

- **`auth`**: requires the user to be authenticated.
- **`admin.access`**: restricts access to administrative roles.
- **`permission`**: checks whether the authenticated user's role contains the permission required by the current route.

The custom `Permission` middleware reads the permission IDs assigned to the authenticated user's role, maps them to route actions, and returns `403 Forbidden` when the current route is not allowed. citeturn6view1turn7view3

The application also defines Laravel Sanctum for authenticated API access. The current API route exposes the authenticated user endpoint through `auth:sanctum`. citeturn2view0turn7view1

---

## Database Design

The application uses MySQL with Laravel migrations to define its relational schema. The project contains separate Eloquent models for core clinic entities including:

```text
User
├── Role
├── Appointment
├── CaseHistory
└── ...

Doctor
└── Schedule
    └── ScheduleFrame

Prescription
└── PrescriptionMedicine
    └── Medicine
        └── Category
```

The model layer uses Eloquent relationships to represent associations between clinic entities. For example, appointments reference both patient and doctor users, while prescriptions coordinate prescription records with their associated medicines. citeturn4view1turn6view2turn8view0

The project also uses dedicated repository classes to encapsulate database operations rather than placing all queries directly in controllers. citeturn4view2

### Transaction Handling

Prescription processing demonstrates explicit database transaction handling when multiple related records must be updated together. The application starts a transaction before updating prescription-medicine records and medicine quantities, commits when all operations succeed, and rolls back when an exception occurs. citeturn8view0

---

## Project Structure

```text
app/
├── Console/                 # Artisan console commands
├── Exceptions/              # Exception handling
├── Http/
│   ├── Controllers/
│   │   ├── Admin/           # Administrative module controllers
│   │   ├── Auth/            # Authentication controllers
│   │   └── Frontend/        # Public frontend controllers
│   ├── Middleware/          # Authentication, admin access, permissions
│   └── Traits/              # Shared controller/service traits
├── Models/                  # Eloquent models and relationships
├── Providers/               # Laravel service providers
├── Repositories/            # Data-access layer
│   ├── Appointment/
│   ├── CaseHistory/
│   ├── Category/
│   ├── Department/
│   ├── Frame/
│   ├── Medicine/
│   ├── Prescription/
│   ├── Schedule/
│   ├── User/
│   ├── BaseRepository.php
│   └── RepositoryInterface.php
├── Services/                # Application-level services
└── helpers.php              # Shared helper functions

database/
├── factories/               # Model factories
├── migrations/              # Database schema migrations
└── seeders/                 # Database seed data

resources/
├── css/                     # Stylesheets
├── js/                      # Frontend JavaScript
├── lang/                    # Localization
└── views/
    ├── admin/               # Administrative Blade views
    └── auth/                # Authentication views

routes/
├── api.php                  # API routes
├── console.php              # Console routes
├── channels.php             # Broadcasting channels
└── web.php                  # Web, auth, frontend, and admin routes

public/
├── assets/                  # Public assets
├── index.php                # Laravel entry point
└── .htaccess                # Apache configuration

config/
├── constants.php            # Application roles and permission constants
├── permission.php           # Permission definitions
└── ...                      # Laravel configuration
```

The repository currently contains the standard Laravel application structure together with custom repositories, services, middleware, models, migrations, seeders, Blade views, and route definitions. citeturn0view0turn4view0turn4view1turn4view2turn4view3turn3view3turn2view3

---

## Project Status

This is an earlier Laravel project and does not currently include a dedicated CI/CD pipeline, Docker-based deployment workflow, or deployed live demo. The repository does include Laravel's PHPUnit development dependency and the standard `tests` directory, but this README intentionally does not present testing as a project capability unless application-specific tests are added.