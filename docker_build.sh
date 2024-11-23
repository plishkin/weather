#!/usr/bin/env bash

docker compose build
docker compose up -d mysql
sleep 5
docker compose up -d laravel.test

docker compose exec laravel.test composer install --optimize-autoloader --ignore-platform-reqs
docker compose restart laravel.test

docker compose up -d

sleep 5
docker compose exec laravel.test php artisan config:clear
docker compose exec laravel.test php artisan migrate
docker compose exec laravel.test npm install --legacy-peer-deps
docker compose exec laravel.test npm run build


