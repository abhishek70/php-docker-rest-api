#!/bin/bash

set -e

SOURCE_DIR=/var/www/html

#https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
#If set to 1, this env disables the warning about running commands as root/super user. 
#It also disables automatic clearing of sudo sessions, so you should really only set 
#this if you use Composer as super user at all times like in docker containers.
export COMPOSER_ALLOW_SUPERUSER=1
(cd ${SOURCE_DIR} && composer install --no-plugins --no-scripts --no-autoloader)

# Creating migration table
php artisan migrate:install

# Executing migration files stored in /app/database/migrations
php artisan migrate

exec "$@"