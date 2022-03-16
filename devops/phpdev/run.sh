#!/usr/bin/env bash

cd /app
composer install
php artisan migrate:fresh --seed
php artisan db:seed
php artisan cache:clear

php artisan serve --host 0.0.0.0 && php artisan queue:work --queue=high,default
