#!/bin/bash

# Install Composer
curl -sS https://getcomposer.org/installer | php
php composer.phar install

# Install Node.js dependencies
npm install

# Build the project
npm run build

# Laravel specific commands
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
