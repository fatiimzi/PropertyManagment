managmentApp Application Setup Guide
Overview
This guide provides instructions on setting up and running this application using XAMPP with SQL.
Prerequisites
1.	XAMPP: Ensure you have XAMPP installed. You can download it from Apache Friends.
2.	Composer: Install Composer for PHP package management. You can get it from getcomposer.org.
3.	PHP: Make sure PHP is installed and configured in your XAMPP environment.
4.	Laravel: The application is built with Laravel. Familiarity with Laravel will be beneficial.
Setup Instructions
1. Clone the Repository
Clone the repository to your local machine :
git clone https://github.com/fatiimzi/PropertyManagment.gitcd your-laravel-app
cd propertymanagment

2. Install Dependencies
Run Composer to install PHP dependencies:
composer install 
composer install
3. Configure Environment
Copy the .env.example file to create a new .env file:
cp .env.example .env

Open the .env file and update the database configuration to match your XAMPP settings:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=propertymanagment
DB_USERNAME=root
DB_PASSWORD=
4. Generate Application Key
Generate a new application key:

php artisan key:generate

5. Create the Database
1.	Open XAMPP Control Panel and start Apache and MySQL.
2.	Access phpMyAdmin via http://localhost/phpmyadmin.
3.	Create a new database with the name specified in your .env file (propertymanagment).
6. Run Migrations
Apply migrations to set up the database schema:
php artisan migrate

7. Seed the Database (Optional)
If you have seeders set up, you can populate the database with sample data:
php artisan db:seed

8. Start the Development Server
Run the Laravel development server:
php artisan serve

The application will be available at http://localhost:8000.
9. Access the Application

Open your web browser and navigate to http://localhost:8000 to view the application.
Additional Commands
•	Clear Cache: php artisan cache:clear
•	View Routes: php artisan route:list
•	Run Tests: php artisan test

