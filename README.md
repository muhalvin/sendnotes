<h1 align="center">Sendnotes</h1>

<p>
SendNote - A way to send schedule notes to your friends.
</p>

## Installation

1. Clone this project
    ```bash
    git clone https://github.com/muhalvin/sendnotes.git

    cd sendnotes
    ```
2. Install dependencies

    ```bash
    composer install
    ```

    And javascript dependencies

    ```bash
    npm install && npm run dev
    ```

3. Set up Laravel configurations

    ```bash
    copy .env.example .env

    php artisan key:generate
    ```

4. Set your database in .env

5. Migrate database

    ```bash
    php artisan migrate
    ```

6. Serve the application

    ```bash
    php artisan serve
    ```

## Requirements
- Laravel (10.43.0)
- PHP (8.2.10)