#!/bin/sh
# Change to the project directory
cd /var/www/expensetracker/prod
# Turn on maintenance mode
php artisan down
# Install/update composer dependecies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
# Run database migrations
php artisan migrate --force
# Clear caches
php artisan cache:clear
# Clear expired password reset tokens
php artisan auth:clear-resets
# Clear and cache routes
php artisan route:clear
php artisan route:cache
# Clear and cache config
php artisan config:clear
php artisan config:cache
# Turn off maintenance mode
php artisan up
