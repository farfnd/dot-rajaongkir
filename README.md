# Province & City API with RajaOngkir (Sprint 1)

Made for DOT Indonesia technical test

## Requirements

-   PHP 8.1
-   Laravel 10
-   MySQL

## Installation

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/farfnd/dot-rajaongkir
    ```

2.  **Install Composer Dependencies:**

    ```bash
    composer install
    ```

3.  **Create a `.env` File:**

    Duplicate the `.env.example` file and rename it to `.env`.

4.  **Create a database:**

    Create a new MySQL database, and update the necessary database credential configurations in the `.env` file.

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Insert RajaOngkir API key:**

    Complete the `RAJAONGKIR_API_KEY` variable in the `.env` file with your API key.

    ```
    RAJAONGKIR_API_URL=https://api.rajaongkir.com/starter
    RAJAONGKIR_API_KEY=<your API key here>
    ```

6.  **Generate an Application Key:**

    ```bash
    php artisan key:generate
    ```

7.  **Run Database Migrations:**

    ```bash
    php artisan migrate
    ```

8.  **Start the Development Server:**

    ```bash
    php artisan serve
    ```

    By default, the application will be available at `http://localhost:8000`.

## Usage

-   Access the application in your web browser at `http://localhost:8000`.
-   Use the provided functionalities according to the application's features.

## Features

-   Store provinces & cities data from RajaOngkir API to database by running the following command:

    ```
    php artisan fetch:provinces
    php artisan fetch:cities
    ```

    City data is dependent to the province data through `province_id` foreign key; therefore the province data must be fetched before the city data. This behavior can be modified by removing the foreign key constraint in the `cities` table migration.

-   API endpoints to get province and city data for authorized users.

    -   `/api/search/provinces?id=<province_id>`: returns data for a province based on the given province ID. Province ID is optional; when not provided, the whole province data will be returned.

    -   `/api/search/cities?id=<city_id>`: returns data for a city based on the given city ID. City ID is optional; when not provided, the whole city data will be returned.
