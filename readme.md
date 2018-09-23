# FORUM

1. Download project
    `git clone git@github.com:BStojanoska/Simple_Forum.git`

2. Run:
    composer install

3. Create a database and rename the .env.example file to .env, then connect the DB

4. Run:
    ```
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    ```
