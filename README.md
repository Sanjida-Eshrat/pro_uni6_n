# College Management System

## Used technologies
* adminlte template 
* Laravel 6
* php 7
* Bootstrap 4
* mysql for database

## Features
* User management(add,edit, delete users)
* Profile management(change profile information, change password)
* Setup management(deparment,semester,fee category,session,shift)
* Student management (enroll,attendance,fees management)
* Teacher management (enroll,attendance,salary management)
* Employee management (enroll,attendance,salary management)
* Account management
* Frontend management

## Installation Steps

### 1. Add the DB Credentials & APP_URL

Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=pro_uni6_n
DB_USERNAME=root
DB_PASSWORD=
```

You will also want to update your website URL inside of the `APP_URL` variable inside the .env file:

```
APP_URL=http://localhost:8000
```

### 2. Install dependencies using composer

This can easily be done by running this command:

```bash
composer install
```

### 3. Run The Installer

Start up a local development server with `php artisan serve` 

## Users

* Admin
* student
* teacher
* accountant
* employee

Try the following info to login as an admin:

>**email:** `admin@gmail.com`   
>**password:** `3180`
