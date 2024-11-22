#!/usr/bin/env bash

docker compose build
docker compose up -d mysql
sleep 5
docker compose up -d laravel.test

docker compose exec laravel.test composer install --optimize-autoloader --ignore-platform-reqs
docker compose restart laravel.test
docker compose exec php artisan config:clear
docker compose exec php artisan migrate
docker compose up -d
docker compose exec npm install --legacy-peer-deps
docker compose exec npm run build

