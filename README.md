# LaraBlog
LaraBlog is a blogging platform built with Laravel, providing features for creating and managing posts, comments, and users. This project also includes auth-based access control and API endpoints secured with Laravel Passport.

Table of Contents
- Installation
- Setup
-- Database
-- Environment Variables
-- Dependencies
- Migrations & Seeders
- Test User
- Passport Setup
- Testing
- API Documentation
- Usage
- Contributing


# Installation
Clone the repository:
git clone https://github.com/codequail/LaraBlog.git
cd LaraBlog


# Setup
Database
Create a database:
Create a new MySQL database for the project.

CREATE DATABASE larablog;


# Environment Variables
Set up database credentials:
Copy the .env.example file to .env and update the database credentials.

Update the following lines in your .env file with your database information:

DB_DATABASE=larablog
DB_USERNAME=your_username
DB_PASSWORD=your_password


# Dependencies
Install dependencies:
Run the following command to install the necessary PHP packages.

composer update


# Migrations & Seeders
Run migrations:
Set up the database schema by running the migrations.

php artisan migrate


# Run seeders:
Seed the database with initial data. Note: Run the UserTableSeeder before PostsTableSeeder.

php artisan db:seed --class=UserTableSeeder
php artisan db:seed --class=PostsTableSeeder


# Test User:
For testing purposes, a user is created with the following credentials:

Email: admin@larablog.com
Password: password
Use these credentials to log in and access user features.


# Passport Setup
Generate Passport keys:
Generate the necessary keys for Laravel Passport for API authentication.

php artisan passport:install


# Testing
To run tests, use the following command:

php artisan test
Ensure your .env.testing file has the correct configuration for testing.


# API Documentation
For API documentation, refer to https://documenter.getpostman.com/view/37418430/2sA3rwMZaY.


# Usage
Starting the server:
Run the local development server.

php artisan serve


# Access the application:
Open your browser and go to http://localhost:8000. or create a virtual host http://larablog.localhost


# Contributing
Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.
