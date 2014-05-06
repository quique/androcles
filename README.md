androcles
=========

A CMS for animal shelters


Requirements
------------

Androcles requires a server with PHP 5.4+ that has the MCrypt extension installed.

The database engine that is used to store data for this application could be any of the engines supported by Laravel: MySQL, Postgres, SQLite and SQL Server.


Configuration
-------------

- Open up `app/config/database.php` and configure connection settings for your database.
- Configure hostname in `bootstrap/start.php` file to match your machine's hostname:

    ```
    $env = $app->detectEnvironment(array(

        'local' => array('your-machine-name'), // Edit this line

    ));
    ```

After this simple configuration you can populate the database by running a couple commands shown below.


Installation
------------

CD into the directory of this project and run the following three commands:

1. `composer install`
2. `php artisan migrate`
3. `php artisan db:seed`
4. Copy the folders of the languages you want from the "vendor/caouecs/laravel4-lang" directory to "app/lang".

This will install all Composer dependencies, create the database structure and populate the database with some sample data so that you could see this project in action.
