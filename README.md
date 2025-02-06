# Streaming Musical Spotify

## Setup

1. Build and start the Docker containers:
    ```sh
    docker-compose up --build
    ```

2. Access the application:
    - PHP app: [http://localhost:8080](http://localhost:8080)
    - Adminer: [http://localhost:8081](http://localhost:8081)

## Project Structure

- `app/`: Contains the PHP application code.
  - `public/`: Publicly accessible files (e.g., `index.php`).
  - `src/`: Application source code.
- `vendor/`: Composer dependencies.
- `composer.json`: Composer configuration file.
- `docker-compose.yml`: Docker Compose configuration.
- `Dockerfile`: Dockerfile for building the PHP environment.
- `README.md`: Project documentation.

## .env example 
```shell 
DB_HOST=localhost
DB_NAME=dbname
DB_USER=username
DB_PASSWORD=pass
DB_DRIVER=pgsql
APP_ENV=development

```