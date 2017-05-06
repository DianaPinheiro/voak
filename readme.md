# Venture Oak API

This API is implemented as a standard Laravel 5.2 project. Laravel is a web application framework with expressive, elegant syntax.

## Requirements

* PHP >= 5.5.9
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* MySQL or MariaDB, any reasonably recent version will do

## Installation

1. Clone this repository to a local directory accessible by your Apache or NGINX web server.
2. Import the supplied SQL script into your preferred DBMS.
3. Configure your database access information in app/database.config
4. Run `composer install` and wait for everything to install.
5. [Optional] Import the supplied route collection to Postman.

## Usage

If you're running the API on a local machine the base route for the API will be similar to `http://127.0.0.1/ventureoak/public`

The following endpoints are available:

 Method | Endpoint        | Description 
 ------------- |  ------------- | -------------- 
 GET | api/v1/companies | Get all companies  
 GET | api/v1/companies/1/reviews | Get all reviews from a specific company 
 POST | api/v1/companies/1/reviews | Create a review for a specific company
 GET | api/v1/companies/1/reviews/minmax | Get lowest and highest review for a specific company
 
 
 
    
    
All routes accept the ```page``` and ```limit``` parameters in order to configure the API paginator.
    