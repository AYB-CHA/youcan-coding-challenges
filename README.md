# YouCan Coding Challenge (Laravel & VueJS)

This is my solution to the fullstack Coding chanllenge by YouCan.

## Installation

Start by cloning the repository.

```bash
  git clone https://github.com/AYB-CHA/youcan-coding-challenges
```

### Database

To start the project, you need a MySQL database, a simple Docker compose file is provided.

To run Docker, you will need to add the following environment variables to your .env file:

`DB_PASSWORD`

`DB_NAME`

.env.example at the root is available for reference.

Alternatively, you can use a local installation of MySQL or mariadb.

### Backend

Go to the backend directory

```bash
  cd backend
```

Install dependencies

```bash
  composer install
```

Set the correct envirement variables.

Start the server

```bash
  php artisan serve
```

### Frontend

Go to the frontend directory

```bash
  cd frontend
```

Install dependencies

```bash
  npm install
```

Add the backend base url enviremnt varaible example:
`VITE_BACKEND_BASEURL='http://127.0.0.1:8000/api'`

Start the server

```bash
  npm run dev
```

Now you can access the application at `http://localhost:5173`

## Cli

To add a product from the cli use

```bash
  php artisan product:create {name} {description} {price} {image url} {--c|categories=*}
```

Example

```bash
  php artisan product:create "Product 1" "Description" "341" "example.com/image.jpeg"
```

## Tests

To run the Tests

```bash
  php artisan test
```
