<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel backend-technical-test

## Installation guide

### Please execute these instruction in the order given to install this project on your computer:
- I carefully tested them in sequence to ensure that they work.

### 1. Clone the repository:
 ```
git clone https://github.com/e-boudhina/BackEndTechnicalTest_DANUBIO.git
```
### 2.  Navigate to the project directory:
 ```
cd FullStackTechnicalTest_DANUBIO
 ```
### 3.  Install composer:
 ```
 composer install
  ```
### 4.  Copy the env file:
 ```
cp .env.example .env
 ```
### 5.  Generate project private key:
 ```
 php artisan key:generate
 ```
### 6.  Create database and migrate tables and seeder data
 ```
php artisan migrate --seed 
```
-  If the database was not created manually you will be prompted to create it. Press (Y)
-  Seeding will seed 20 properties into your database
### 7.  Create database and migrate tables and seeder data 
```
php artisan optimize
 ```
### 8.  Run project
 ```
php artisan serve
 ```

## Security Vulnerabilities

If you discover a security vulnerability within project, please send an e-mail to Taylor Otwell via [elyesboudhina@esprit.tn](mailto:elyesboudhina@esprit.tn). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Happy Coding! 🚀

<marquee>Happy Coding! 🎉🚀 Keep building awesome projects!</marquee>
