# Venture Oak API

This API is implemented as a standard Laravel 5.2 project.
Laravel is a web application framework with expressive, elegant syntax.

## Requirements

* PHP >= 5.5.9
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* MySQL or MariaDB, any reasonably recent version will do

## Installation

1. Clone this repository to a local directory accessible by your Apache or NGINX web server.
2. Import the supplied SQL script into your preferred DBMS (`/api.sql`).
3. Configure your database access information in `app/database.config`
4. Run `composer install` in a console and wait for everything to install.
5. [Optional] Import the supplied route collection to Postman (`/postman_collection.json`).

## Usage

If you're running the API on a local machine the base route for the API will be similar to `http://127.0.0.1/ventureoak/public/api/v1/`

You can use any client but Postman is recommended. A route collection for Postman is provided.

### Endpoints

The following endpoints are available:

| Get all companies | |
| ----- | -------------- |
| URL | `companies` |
| Method | GET |
| URL Params | **Optional** |
|    | page=[integer] |
|    | limit=[integer] |
|    | example: page=3&limit=5 |
| Sucess Response | **Code:** 200 - A collection of companies |
| Error Response | No error response is expected |

  
| Get all reviews from a specific company | |
| ----- | -------------- |
| URL | `companies/:id/reviews` |
| Method | GET |
| URL Params | **Optional** |
|    | page=[integer] |
|    | limit=[integer] |
|    | example: page=3&limit=5 |
| Sucess Response | **Code:** 200 - A collection of reviews from a company or a empty array if no reviews are available |
| Error Response | **Code:** 404 - No company with specified id was found |
   

| Create a review for a specific company | |
| ----- | --------------
| URL | `companies/:id/reviews`
| Method | POST
| URL Params | No parameters are available
|    | Request body expects all required inputs:
|    | title, userEmail, reviewRatingCulture, reviewRatingManagement, reviewRatingWorkLiveBalance, reviewRatingCareerDevelopment, pro, contra, suggestion
| Sucess Response | **Code:** 201 - No content is provided
| Error Response | **Code:** 404 - No company with specified id was found
|    | **Code:** 422 - The request has invalid data
|    | **Code:** 409 - The user has already provided a review for this company
  
  
| Get the lowest and highest reviews from a specific company | |
| ----- | --------------  |
| URL | `companies/:id/reviews/minmax` |
| Method | GET |
| Sucess Response | **Code:** 200 - A collection of reviews from a company or a empty array if no reviews are available |
| Error Response | **Code:** 404 - No company with specified id was found |

