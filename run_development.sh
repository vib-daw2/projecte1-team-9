#!/usr/bin/env bash
# Check if .env file exists
if [ ! -f "./.env" ]; then
    echo "No .env file found. Copying .env.example to .env"
    cp .env.example .env
fi

# Remove the old DB_PASSWORD and DB_USERNAME
sed -i '' '/DB_PASSWORD/d' "./.env"
sed -i '' '/DB_USERNAME/d' "./.env"
sed -i '' '/DB_DATABASE/d' "./.env"

echo "DB_PASSWORD=1234" >> "./.env"
echo "DB_USERNAME=root" >> "./.env"
echo "DB_DATABASE=laravel" >> "./.env"

echo "Trying to delete existing containers."
docker stop mysql
docker rm mysql

docker run \
    --name mysql \
    -e MYSQL_ROOT_PASSWORD=1234 \
    -e MYSQL_DATABASE=laravel \
    -e MYSQL_PASSWORD=1234 \
    -p 3306:3306 \
    -d mysql:latest

sleep 10 # Wait for the database to be ready

npm install && \
composer install && \
php artisan migrate:fresh && \
php artisan key:generate && \
php artisan db:seed && \
(php artisan serve & npm run dev &
sleep 2 && \
echo "Done. Press any key to stop the server.")

read -n 1 -s -r -p ""
killall php
killall node
docker stop mysql
docker rm mysql
