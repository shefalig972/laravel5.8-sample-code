## Manage Contact WebServices

This sample code provides REST API for managing contacts. Registered user after login can create contacts. It is similar to maintaining address book.

User authentication using JWT is implemented. All the REST API can be access by passing bearer auth token in the header.

## REST APIs

All the API routes are being declared in **routes/api.php** file.


## CRUD Operations on Contact.

The CRUD operations on contacts are written in **app/Http/Controllers/ContactController.php** file. 
PHP Traits are used to implement DRY pattern of development. In **app/Http/Traits/Api/Common/ContactTrait.php** file most of the common functions are written, which can be included in other controllers.

## Validations

All the validation applied in the project is by using Request classes, which can found on path /app/Http/Requests/
  
## Setup Steps

### 1. Setup Environment

Copy **.env.example** to **.env** file and write the database connection values.

### 2. Install Dependencies

Run `composer install` command to install the dependencies

### 3. Create Database

Run `php artisan migrate` to run the migration that will create all the database tables.

### 4. Run Database Seeder

Run `php artisan db:seed` to run seed the database with default values.
