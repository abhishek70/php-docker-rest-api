# PHP REST APIs

Get Laravel 5.8.x database for your non laravel projects. Built on top of illuminate/database to provide migration, seeding and artisan support 

## Dependencies used in the application
```
Apache 2.0
PHP 7.3.*
MySQL-Server 5.6
Composer 1.9.*
Laravel 5.8.*
```

Available artisan commands
```
dump-autoload        Regenerate framework autoload files
  env                  Display the current framework environment
  help                 Displays help for a command
  list                 Lists commands
  migrate              Run the database migrations
  serve                Serve the application on the PHP development server
  tinker               Interact with your application
 db
  db:seed              Seed the database with records
 ide-helper
  ide-helper:eloquent  Add \Eloquent helper to \Eloquent\Model
  ide-helper:generate  Generate a new IDE Helper file.
  ide-helper:meta      Generate metadata for PhpStorm
  ide-helper:models    Generate autocompletion for models
 make
  make:command         Create a new Artisan command
  make:controller      Create a new controller class
  make:factory         Create a new model factory
  make:migration       Create a new migration file
  make:model           Create a new Eloquent Model
  make:seed            Create a new seeder class
  make:test            Create a new test class
 migrate
  migrate:fresh        Drop all tables and re-run all migrations
  migrate:install      Create the migration repository
  migrate:refresh      Reset and re-run all migrations
  migrate:reset        Rollback all database migrations
  migrate:rollback     Rollback the last database migration
  migrate:status       Show the status of each migration
 vendor
  vendor:publish       Publish any publishable assets from vendor packages
```

## Steps for running application on development machine
* Run below command for running application on default port 8000
```
php artisan serve
``` 

* Run below command for running application on specific port and host
```
php artisan serve --port=8080 --host=apiserver.dev
```

## Steps for running application using docker
* Make sure all the folders inside `app/storage` have write permission for the application to write the needed files for caching
  
* Create `.env` by cloning `.env.example`
 
```
cp .env.example .env
```
* Run below docker-compose command to build the container

```
docker-compose up -d
```

## Steps for running application on localhost using docker with SSL
1. Create self-signed SSL certificate for localhost domain
2. Self-signed SSL certificate creates *.crt and *.key files
3. Rename *.crt with server.crt and *.key with server.key if files created in step 2 are with different name
4. Copy server.crt and server.key files to the root directory

**Note - Using self-signed SSL certificate for production environment is not recommended.

* Run below docker-compose command to build the container with HTTP(S)
```
docker-compose -f docker-compose.local.yml up -d
```

## Swagger documentation
```
http://localhost:3000/apidocs/

https://localhost:8085/apidocs/
```

## Execute unit and integration tests using PHPUnit
```
docker-compose exec -T restapi php ./vendor/bin/phpunit --log-junit test-results.xml
```

![image](https://github.com/abhishek70/php-docker-rest-api/blob/master/screenshots/apidocs.png)

## Official documentation
[Luracast/Laravel-Database](https://github.com/Luracast/Laravel-Database)

[Luracast/Restler](http://restler3.luracast.com/index.html#quick-start-guide)

[Laravel](https://laravel.com/docs/5.8)

[PHP-Docker](https://hub.docker.com/_/php)

[Composer-Docker](https://hub.docker.com/_/composer)

[MySQL-Docker](https://hub.docker.com/r/mysql/mysql-server)
