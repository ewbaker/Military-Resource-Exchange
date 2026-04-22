# Air Force Gear Rental System

This project is a web application for managing and renting equipment, built for the CS 262 WebDev course w/ Professor Agbo. It features a role-based user permission system where a user's ability to add new equipment is determined by their "trust" level, which is analyzed by an AI.

## About The Project

This application allows users to browse a catalog of available gear. Authenticated users can borrow up to five items. The system includes a unique trust/rank system for users. A user's rank, which determines their privileges, is adjusted based on an AI analysis of performance reports.

### Built With

*   [Laravel](https://laravel.com/)
*   MySQL
*   [Ollama](https://ollama.com/) for AI-based user rank assessment.

---

## Getting Started

To get a local copy up and running, please follow these simple steps.

### Prerequisites

Before you begin, you must have the following software installed on your machine.

*   PHP >= 8.1
*   [Composer](https://getcomposer.org/)
*   A web server (like Apache or Nginx)
*   A database server (like MySQL or MariaDB)
*   **Ollama:** This project uses Ollama to power its AI features.
    1.  Download and install Ollama from the [official website](https://ollama.com/).
    2.  After installation, you must pull the model used by the application by running the following command in your terminal:
        ```sh
        ollama pull llama3
        ```
    3.  Ensure the Ollama application is running before you start the Laravel application.

### Installation

1.  **Clone the repository to your local machine.**
    ```sh
    git clone [your-repository-url]
    ```
2.  **Navigate into the project directory.**
    ```sh
    cd [project-folder-name]
    ```
3.  **Create a copy of the `.env.example` file and name it `.env`.**
    ```sh
    cp .env.example .env
    ```
4.  **Install all PHP dependencies using Composer.** This will download Laravel and all other required packages into a `vendor` folder.
    ```sh
    composer install
    ```
5.  **Generate a new application key.**
    ```sh
    php artisan key:generate
    ```
6.  **Configure your database.** Open the new `.env` file and enter your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```
7.  **Import the database.** Using a database management tool like phpMyAdmin, import the provided `database.sql` file into the database you just configured. This will create all the necessary tables and seed them with the test users.
    *Note: If the database is empty after import, you can also try running `php artisan db:seed` to populate the inventory.*

8.  **Create the storage link.** This is necessary for making uploaded files and images publicly accessible.
    ```sh
    php artisan storage:link
    ```

9.  **Start the local development server.**
    ```sh
    php artisan serve
    ```
    The application will now be running at `http://127.0.0.1:8000`.

---

## Usage

The application allows anyone to view the equipment catalog. To borrow equipment, you must be logged in.

### Test Users

You can use the following pre-loaded user accounts to test the different permission levels. The password for all users is `password`.

1.  **High-Rank User (Can add new items)**
    *   **Email:** `e1.baker@us.af.mil`
    *   **Password:** `password`

2.  **Standard User**
    *   **Email:** `gen.agbo@us.af.mil`
    *   **Password:** `password`
    

3.  **Low-Rank User (Cannot add new items)**
    *   **Email:** `o5.wilson@us.af.mil`
    *   **Password:** `password`

### Features

*   **Borrowing Gear**: Log in to borrow equipment from an item's page.
*   **Item Limit**: Each user can borrow a maximum of **5 items**.
*   **Adding New Gear (High-Rank Users)**: Users with a high trust/rank can add new items to the catalog.
*   **Restricted Privileges (Low-Rank Users)**: Users with a low rank lose the privilege to add new items. This rank is determined by a custom review system where reports from the Air Force chain of command are analyzed by Ollama to adjust the user's trust level.