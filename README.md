# HereInAfter Library API Documentation

This is the HereInAfter Library API, a RESTful API for managing a library's book collection. It allows publishers to perform CRUD operations on books, get user tokens for authentication, and more.

## Implemented Logic

- CRUD operations for managing books.
- User authentication with bearer tokens.
- Endpoint to get user tokens based on user ID (for testing purposes only).
- Manual pagination for better control over data retrieval.

## Technologies Used

- Laravel: A PHP web application framework used for backend development.
- MySQL: A relational database management system for storing book and user data.
- Composer: A dependency manager for PHP used for installing project dependencies.
- Artisan: Laravel's command-line tool for various tasks, including migrations and serving the application.


## Eloquent Relationships

### Book Model

#### Authors Relationship

- **Type:** Many-to-Many
- **Method:** `$this->belongsToMany(Author::class);`

#### Publisher Relationship

- **Type:** Belongs To Many
- **Method:** `$this->belongsToMany(Publisher::class);`

### Author Model

#### Books Relationship

- **Type:** Many-to-Many
- **Method:** `$this->belongsToMany(Book::class);`

### Publisher Model

#### Books Relationship

- **Type:** Belongs To Many
- **Method:** `$this->belongsToMany(Book::class);`

---

## Some Explanation

Test description does not contain all the information so I've coded it by assuming following things:

- User is already registered (seeding)
- A user can be a publisher
- User will use its authentication token to make changes as a publisher
- Authors are termed as seperate resource and are not user of the application


## Setup and Run Locally

To run this project locally, follow the steps below:

1. Clone the repository:

   ```bash
   git clone https://github.com/abrarprogrammer/hereinafter-library.git
   ```

2. Navigate to the project directory:

   ```bash
   cd hereinafter-library
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Create a copy of the `.env.example` file and rename it to `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your database settings in the `.env` file.

7. Run database migrations:

   ```bash
   php artisan migrate
   ```

8. Seed the database:

   ```bash
   php artisan db:seed
   ```

9. Start the development server:

   ```bash
   php artisan serve
   ```

10. The API will be available at `http://127.0.0.1:8000` by default.

## API Endpoints

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/30810909-c479eca0-8bd1-4b7b-bd81-76ebe6464b6e?action=collection%2Ffork&collection-url=entityId%3D30810909-c479eca0-8bd1-4b7b-bd81-76ebe6464b6e%26entityType%3Dcollection%26workspaceId%3Dfe73aa95-5a73-4a0d-bcbf-71243134ee4e)

## Get User Token

Get the user token for authentication.

### Request

- **URL:** `http://127.0.0.1:8000/api/test/get-token/{user_id}`
- **Method:** `GET`

### Response

- Status: `200 OK`
- Body: `<token>`

---


## Add Book

Add a new book to the library.

### Request

- **URL:** `http://127.0.0.1:8000/api/book`
- **Method:** `POST`
- **Authorization:** Bearer Token
- **Token:** `<token>`
- **Body:** form-data
  - `name`: Book name
  - `author_ids`: 5,7

### Response

- Status: `201 Created`

---

## Modify Book

Modify details of a book in the library.

### Request

- **URL:** `http://127.0.0.1:8000/api/book/{book_id}`
- **Method:** `PUT`
- **Authorization:** Bearer Token
- **Token:** `<token>`
- **Query Params:**
  - `name`: Updated book name

### Response

- Status: `200 OK`
- Body: JSON representation of the modified book

---

## Delete Book

Delete a book from the library.

### Request

- **URL:** `http://127.0.0.1:8000/api/book/{book_id}`
- **Method:** `DELETE`
- **Authorization:** Bearer Token
- **Token:** `<token>`

### Response

- Status: `204 No Content`
