<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation Guide

Follow these steps to install and set up the project:

1. **Install dependencies using Composer:**
    ```sh
    composer install
    ```

2. **Add the `.env` file sent to you via email to the root directory of the project. Update the following variable to use SQLite:**
    ```env
    DB_CONNECTION=sqlite
    ```

3. **Find the Cloudflare R2 configuration in the email and add the following variables to the `.env` file:**
    ```env
    CLOUDFLARE_R2_ENDPOINT=GET FROM EMAIL
    CLOUDFLARE_ACCESS_KEY_ID=GET FROM EMAIL
    CLOUDFLARE_ACCESS_KEY_SECRET=GET FROM EMAIL
    CLOUDFLARE_R2_BUCKET_NAME=GET FROM EMAIL
    CLOUDFLARE_R2_ACCOUNT_ID=GET FROM EMAIL
    ```

4. **Generate the application key:**
    ```sh
    php artisan key:generate
    ```

5. **Run the database migrations:**
    ```sh
    php artisan migrate
    ```

6. **Install frontend dependencies using npm:**
    ```sh
    npm install
    ```

7. **Start the Laravel development server:**
    ```sh
    php artisan serve
    ```

8. **Run the frontend development server:**
    ```sh
    npm run dev
    ```

## Project Description

This project was developed as part of an assignment for the Full Stack Developer Internship at CyberElysium. The key requirements and features of the project are as follows:

- **Framework:** Laravel 10
- **SPA Framework:** Inertia.js
- **Design Pattern:** Facade Design Pattern
- **Authentication:** Breeze
- **Frontend Framework:** Vue.js
- **Styling:** Bootstrap
- **Storage:** AWS SDK with Cloudflare R2 Storage

### Features

1. **User Authentication:**
   - Implemented login functionality that redirects users to the Dashboard upon successful authentication.

2. **CRUD Operations for Students:**
   - Users can add, view, edit, and delete student records.
   - Each student record includes an ID, name, image, age, and status (active/inactive).

## Tools Used

- **Laravel 10:** For backend development.
- **Inertia.js:** To create a seamless single-page application experience.
- **Facade Design Pattern:** Implemented as per project requirements.
- **Breeze Authentication:** For setting up the authentication system.
- **Vue.js:** For the frontend, integrated with Inertia.js.
- **Bootstrap:** For responsive design and styling.
- **AWS SDK with Cloudflare R2 Storage:** For image uploads and secure file handling.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
