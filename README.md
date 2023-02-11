<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## Laragigs Project

Laragigs is a web application for finding and posting gigs. It is built with Laravel 9 and Tailwind CSS. It is a project for learning Laravel 9 and Tailwind CSS.

## Functionalities of the Application

- View a list of all job listings

![Home Page](/readme_resources/Edit_Gig.png)

- Create a user account and log into the application

![Register Page](/readme_resources/Register.png)

- Create a job listing with a title, description, and a way for users to contact the poster and manage all listings created by the user

![Manage Gig Page](/readme_resources/Manage_Gigs.png)

## Installations (MacOS)

1. Install PHP 8.0

```bash
brew install
```

2. Install Composer

Run the 3 installation commands on the terminal from the [Composer Website](https://getcomposer.org/download/)

3. Install Database (MySQL Server & MySQL Workbench)
Download and install MySQL Server and MySQL Workbench from the [MySQL Website](https://dev.mysql.com/downloads/mysql/)

4. Create & Install Laravel Project with Composer

```bash
composer create-project --prefer-dist laravel/laravel PROJECT_NAME
```
5. Configure Database Details

After installing MySQL Server and MySQL Workbench, create a database and configure the database details in the .env file in the root directory of the project.

```mysql
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1 
DB_PORT=3306 
DB_DATABASE=<DATABASE NAME>
DB_USERNAME=<DATABASE USERNAME>
DB_PASSWORD=<DATABASE PASSWORD>
```

To test the connection, run the following command on the terminal:

```bash
php artisan migrate
```
All of the premade tables should be displayed on mySQL Workbench.

6. Serve the Laravel Project

```bash
php artisan serve
```

## Laravel Project Basic Workflow

The following example is a basic workflow for implementing authentication.

1. Create a route for creating a new user on the web.php file

```php
// Show Register Create Form
Route::get('/register', [UserController::class, 'create']);
```

2. Create a controller for the route by running the following command on the terminal

```bash
php artisan make:controller UserController
```

3. Create a method for the route in the UserController

```php
public function create()
{
    return view('users.register');
}
```
