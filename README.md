

---

# Laravel Multilanguage Base

## Overview

This repository provides a robust and flexible Laravel base project that simplifies the integration of multilingual models and user interface components. It was created to address the need for a clean and scalable foundation for multilingual support within Laravel-based applications.

## Problem Statement

Managing multilingual content in Laravel projects can become complex and repetitive, especially when scaling across multiple models. This project solves that challenge by offering a structure where any translatable model can be seamlessly integrated by simply extending a base model class, significantly reducing the amount of required boilerplate code.

## How It Works

The application automatically serves content based on the language set by the requesting user. If the model supports translation, it returns all translatable attributes in the appropriate language. Additionally, it includes a demonstration of a language-agnostic search feature that queries across all supported languages, as well as fully localized UI translations.

## Use of AI Tools in Development

Throughout the development process, Google's **Gemini Pro Max** was utilized extensively. AI-assisted coding was employed to streamline development by dynamically providing suggestions and generating code snippets based on the current file context. This resulted in writing minimal manual code, except when specific corrections or logic adjustments were required.

## Technologies Used

* **Laravel** (PHP Framework)
* **Inertia.js** (Frontend bridge for SPA development)
* **Vue.js** (Reactive UI framework)
* **SQLite** or compatible database

These technologies reflect the current stack used in the main **Next** project.

## Getting Started

### Prerequisites

Ensure that your local environment meets the requirements outlined in the Laravel documentation:
🔗 [Laravel Installation Guide](https://laravel.com/docs/master/installation#installing-php)

### Installation

Once your environment is ready, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
   ```

2. Install frontend and backend dependencies:

   ```bash
   npm install && npm run build
   composer install
   ```

3. Run the Laravel development server:

   ```bash
   composer run dev
   ```

4. Run database migrations and seeders:

   ```bash
   php artisan migrate
   php artisan db:seed --class=TranslationsSeeder
   php artisan db:seed --class=ItemsSeeder
   ```

## License

This project is open-source and available under the [MIT License](LICENSE).

