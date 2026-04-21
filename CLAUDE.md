# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Development server
php artisan serve

# Assets
npm run dev          # Development build
npm run watch        # Watch mode
npm run production   # Production build

# Database
php artisan migrate
php artisan db:seed

# Tests
php artisan test
# or
./vendor/bin/phpunit --filter TestName   # Run a single test

# Cache
php artisan cache:clear
php artisan config:cache
```

## Architecture

**Clinic Management System** — a Laravel 8 MVC app for patient registration and visit tracking. Server-side rendered with Blade + CoreUI (Bootstrap 4 admin theme), jQuery DataTables for paginated lists.

### Domain Model

Three core models with soft deletes:
- **Patient** — `registration_number, name, birth_date, age, address, phone, email` → `hasMany(Visit)`
- **Visit** — `patient_id, visit_date, complaint, diagnosis, medication` → `belongsTo(Patient)`
- **User** — authentication with email verification

### Repository Pattern

All database access goes through repositories extending `BaseRepository` (find, all, create, update, delete, paginate). Each repository declares `$fieldSearchable` for DataTables filtering.

```
app/Repositories/
├── BaseRepository.php       # Abstract base
├── PatientRepository.php
├── VisitRepository.php
└── UserRepository.php
```

Controllers inject repositories via constructor (not Eloquent directly).

### Request Validation

Validation lives in Form Request classes under `app/Http/Requests/`. Model classes define `$rules` as a static property; request classes reference `Model::$rules`.

### Controllers

- `PatientController` — patient CRUD + `storePatientVisit` (creates patient + first visit in one transaction)
- `VisitController` — visit CRUD scoped to a patient
- `UserController` — user management with `verify` action
- `API/VisitAPIController` — two endpoints for Select2 autocomplete: `getDistinctDiagnosis`, `getDiagnosisByVisitId`
- `AppBaseController` — base class providing `sendResponse()`, `sendError()`, `sendSuccess()` helpers

### Routes

All web routes are behind `auth` middleware. API routes (`/api/visits/diagnosis`, `/api/visit/diagnosis/{id}`) serve diagnosis data for the Select2 dropdowns in visit forms.

### Frontend

Blade views use a CoreUI layout with a persistent sidebar. DataTables are server-side rendered via `yajra/laravel-datatables`. Each module has `table.blade.php` (DataTable config) and `fields.blade.php` (shared form fields).

Assets compile from `resources/js/app.js` and `resources/sass/app.scss` into `public/js/app.js` and `public/css/app.css` via Laravel Mix.
