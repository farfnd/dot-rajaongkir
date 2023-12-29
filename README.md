# Province & City API with RajaOngkir (Sprint 2)

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
    USE_RAJAONGKIR_API=false
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

    -   `/api/search/provinces?id=<province_id>`: returns data for a province based on the given province ID. Province ID is optional; the whole province data will be returned when not provided.

        ![Pro](https://github.com/farfnd/dot-rajaongkir/assets/70105993/b75aed3e-40d6-4c63-be4b-c15ba567b553)

        ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/7d7eea15-c5bc-4983-b2ef-2f62c3fad104)

    -   `/api/search/cities?id=<city_id>`: returns data for a city based on the given city ID. City ID is optional; the whole city data will be returned when not provided.

        ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/f61395eb-c83a-48bb-a692-f4b9229b30c4)

        ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/4a067fde-3a3d-4f5a-8346-37f14c306fd8)

-   Swappable implementation of province & city data retrieval. Set the `USE_RAJAONGKIR_API` variable in the `.env` file to `true` to fetch province & city data using RajaOngkir API, and set to `false` to fetch province & city data stored in the database.

    ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/0278f4a0-466a-451f-bcf0-49855678e44e)
    
    ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/97b7da31-5d77-493f-9021-58758caeca8d)

-   User authorization endpoints:

    -   `/api/register`: User registration endpoint (input: name, email, password)
    
        ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/4570db49-c10f-49cd-b682-bca650aa245c)

    -   `/api/login`: User login endpoint (input: email, password); returns Bearer token for authorizing province and city data fetch request.

        ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/28c107ae-447a-4ad8-abeb-b711003d2cce)

    -   `/api/logout`: User logout endpoint. Deletes user token.

        ![image](https://github.com/farfnd/dot-rajaongkir/assets/70105993/50b3e7d1-11a0-46eb-aa93-b570597d889e)

-   Feature tests for the API endpoints.

## Testing

1. **Run PHPUnit Tests:**

    ```bash
    php artisan test
    ```

    This command will run all the tests in the `tests` directory, and will wipe out all the data stored in the database prior to running the tests.
