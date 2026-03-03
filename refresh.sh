#!/bin/bash

echo '---------- Run migrations ----------'
php artisan migrate:fresh --force

echo '---------- Installing Users ----------'
php artisan db:seed

echo '---------- Installing Account Platforms ----------'
php artisan seed:account-platforms

echo '---------- Installing Categories ----------'
php artisan seed:categories

echo '---------- Installing Variant Units ----------'
php artisan seed:variant-units

echo '---------- Installing Products ----------'
php artisan seed:products
