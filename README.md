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
cd BackEndTechnicalTest_DANUBIO
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
# API - "Search" Endpoints

- This section explains how to use the search functionality of the Real Estate API. The search endpoint allows you to filter properties by various criteria such as type, address, size, price, and number of bedrooms. Below are examples of how to test the search functionality using different parameters.

## [ Search Endpoints Part 1 ]

`GET /api/realestate/search`

### ==> PLEASE NOTE That the request body must be **EMPTY** when making `GET` requests <===

## Test Cases

### 1. *Fetching real estates*

`GET http://127.0.0.1:8000/api/realestate`

### 2. *Creating a new real estate*
```
{
"type": "House",
"address": "Kneza Mihaila 50, Belgrade, Serbia",
"size": 200.00,
"size_unit": "m2",
"bedrooms": 5,
"price": 4000000,
"location": {
"lat": 44.8176,
"lon": 20.4633
}
}
```

### 3. *Updating real estate under the id "1"*
`PATCH http://127.0.0.1:8000/api/realestate/1`
```
{
    "type": "Apartment",
    "address": "10 Downing Street, London, UK",
    "size": "75.00",
    "size_unit": "m2",
    "bedrooms": 3,
    "price": "500000.00",
    "location": {
        "latitude": "-0.1276",
        "longitude": "51.5034"
    }
}
```
### 4. *Deleting real estate under the id "1"*
`DELETE http://127.0.0.1:8000/api/realestate/1`


### 5. *Filter by Property Type*
- Target URL is : ``` Get http://127.0.0.1:8000/api/realestate/search```

####  5.1. *Filter by House*:
```
http://127.0.0.1:8000/api/realestate/search?type=House
```
#### 5.2. *Filter by  Apartment*:
```
http://127.0.0.1:8000/api/realestate/search?type=Apartment
```
#### 5.3. *Filter by Address*:
```
http://127.0.0.1:8000/api/realestate/search?address=paris
http://127.0.0.1:8000/api/realestate/search?address=hollywood Boulevard  
http://127.0.0.1:8000/api/realestate/search?address=palace
```
#### 5.4. *Filter by Size*:
```
http://127.0.0.1:8000/api/realestate/search?size_min=100&size_unit=m2
http://127.0.0.1:8000/api/realestate/search?size_max=1000&size_unit=SQFT
http://127.0.0.1:8000/api/realestate/search?size_min=900&size_max=1000&size_unit=SQFT
```

#### 5.5. *Filter by Price*:
```
http://127.0.0.1:8000/api/realestate/search?price_min=1000000
http://127.0.0.1:8000/api/realestate/search?price_max=800000
http://127.0.0.1:8000/api/realestate/search?price_max=500000&price_min=100000
```
#### 5.6. *Filter by Number of bedrooms*:
```
http://127.0.0.1:8000/api/realestate/search?bedrooms=6
```

## [ Search Endpoints Part 2 ]

- Target URL is : ``` Get http://127.0.0.1:8000/api/realestate/searchByLocationAndRadius```
- This feature allows you to filter properties by their radius (R) in Kilometers (KM) Given the coordinates (X: Longitude, Y: Latitude) Below are examples of how to test the search functionality using different parameters.

### 1. *Filter by location using longitude, latitude and radius in Kilometers (KM)*:
```
http://127.0.0.1:8000/api/realestate/searchByLocationAndRadius?lat=40.7128&lon=-74.0060&radius=4000
http://127.0.0.1:8000/api/realestate/searchByLocationAndRadius?lon=51.5034&lat=-0.1276&radius=100
http://127.0.0.1:8000/api/realestate/searchByLocationAndRadius?lon=51.5034&lat=-0.1276&radius=1000
```

## Future Work
- Exception Handling:Implement try-catch blocks in functions for better error management.
- Validation Refactoring: Move validation rules to a separate Request folder to reduce controller clutter and improve code maintainability.
- Performance Optimizations: Improve query efficiency and consider adding pagination for better performance.
- Code Refactoring: Periodic refactoring for a cleaner and more maintainable codebase.
- IMPLEMENTING CI/CD pipeline with docker: I have hands-on experience with DevOps, including setting up Jenkins CI/CD pipelines for building and deploying containerized apps. 
My skills include: Creating Jenkins pipelines for automation. Setting up Docker (Dockerfile, Docker Compose). Configuring GitHub webhooks for automated builds.  Efficiently using Jenkins plugins and parameters.

## Security Vulnerabilities

If you discover a security vulnerability within project, please send an e-mail to Taylor Otwell via [elyesboudhina@esprit.tn](mailto:elyesboudhina@esprit.tn). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Happy Coding! 🚀

<marquee>Happy Coding! 🎉🚀 Keep building awesome projects!</marquee>
