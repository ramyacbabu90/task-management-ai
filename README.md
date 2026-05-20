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
```
