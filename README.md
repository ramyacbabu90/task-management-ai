# AI-Powered Task Management System

A production-ready Laravel 10 Task Management System built using **Repository Pattern**, **Service Layer Architecture**, **Policies**, **REST APIs**, **Queued AI Processing**, and **Tailwind CSS UI**.

This project was developed as part of a Laravel Senior Developer Machine Test.

---

# 🚀 Features

## Authentication & Roles
- Laravel Breeze Authentication
- Role-based access control
- Admin & User roles
- Protected routes and policies

---

## Task Management
- Create Tasks
- Edit Tasks
- Delete Tasks
- View Task Details
- Task Status Management
- Priority Management
- Due Date Management
- User Assignment

---

## AI Integration
- AI-generated task summaries
- AI-generated priority suggestions
- Gemini/OpenAI integration
- Queue-based AI processing
- Fallback response handling
- Prompt engineering implementation

---

## Dashboard & Analytics
- Total Tasks
- Completed Tasks
- Pending Tasks
- High Priority Tasks
- Chart.js analytics dashboard

---

## Repository Pattern
Implemented clean Repository Pattern architecture:

```plaintext
Controller
   ↓
Service Layer
   ↓
Repository Interface
   ↓
Repository Implementation
   ↓
Model


## 🧱 Architecture Structure

```plaintext
app/
├── Enums/
│
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   ├── DashboardController.php
│   │   ├── TaskController.php
│   │   └── UserController.php
│   │
│   ├── Requests/
│   │   ├── StoreTaskRequest.php
│   │   └── UpdateTaskRequest.php
│   │
│   └── Resources/
│       └── TaskResource.php
│
├── Jobs/
│   └── ProcessTaskAIJob.php
│
├── Models/
│   ├── Task.php
│   └── User.php
│
├── Policies/
│   └── TaskPolicy.php
│
├── Repositories/
│   ├── Contracts/
│   │   └── TaskRepositoryInterface.php
│   │
│   └── Eloquent/
│       └── TaskRepository.php
│
├── Services/
│   ├── AIService.php
│   ├── DashboardService.php
│   └── TaskService.php
│
└── Providers/
    └── AuthServiceProvider.php
```


## ⚙️ Tech Stack

| Technology | Usage |
|---|---|
| Laravel 10 | Backend Framework |
| PHP 8.1 | Server-side Programming |
| MySQL | Database |
| Blade | Frontend Templating |
| Tailwind CSS | UI Styling |
| Chart.js | Dashboard Analytics |
| Laravel Sanctum | API Authentication |
| Laravel Queues | Background Job Processing |
| Gemini API / OpenAI | AI Task Summarization |
| Repository Pattern | Clean Architecture |
| Service Layer | Business Logic Separation |
| PHPUnit | Feature & Unit Testing |
| Vite | Frontend Asset Bundling |
| Git & GitHub | Version Control |


## 📡 API Endpoints

| Method | Endpoint | Description | Authentication |
|---|---|---|---|
| GET | `/api/tasks` | Fetch all tasks | Sanctum |
| POST | `/api/tasks` | Create a new task | Sanctum |
| PATCH | `/api/tasks/{id}/status` | Update task status | Sanctum |
| GET | `/api/tasks/{id}/ai-summary` | Fetch AI-generated summary | Sanctum |

---

## 🔐 API Authentication

Generate token using Laravel Sanctum.

Example Header:

```http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
```


# ⚙️ Installation & Setup

## 1. Clone Repository

```bash
git clone https://github.com/ramyacbabu90/task-management-ai
(branch master)
cd task-management-ai
```

---

## 2. Install Dependencies

```bash
composer install
npm install
```

---

## 3. Environment Setup

```bash
cp .env.example .env
```

Update `.env` with:
- database credentials
- Gemini/OpenAI API key

Example:

```env
DB_DATABASE=task_management_ai
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database

GEMINI_API_KEY=your_api_key
```

---

## 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 5. Run Database Migrations

```bash
php artisan migrate
```

---

## 6. Seed Database

```bash
php artisan db:seed
```

---

## 7. Start Development Server

```bash
php artisan serve
```

---

## 8. Start Vite

```bash
npm run dev
```

---

## 9. Start Queue Worker

```bash
php artisan queue:work
```

AI summaries are processed asynchronously through queues.

---

# 🧪 Run Tests

Run all feature and unit tests:

```bash
php artisan test
```

---

# 📡 Test APIs

Generate Sanctum token using Tinker:

```bash
php artisan tinker
```

```php
$user = App\Models\User::first();
$user->createToken('api-token')->plainTextToken;
```

Use token in API requests:

```http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
```
