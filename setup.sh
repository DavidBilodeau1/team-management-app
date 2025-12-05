#!/bin/bash

set -e

echo "Setting up Team Management Application..."

if ! command -v docker &> /dev/null; then
    echo "Docker is not installed. Please install Docker first."
    exit 1
fi

if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
    echo "Docker Compose is not installed. Please install Docker Compose first."
    exit 1
fi

if [ ! -f .env ]; then
    cp .env.example .env
    echo "Created .env file from .env.example"
fi

sed -i.bak 's/DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
sed -i.bak 's/DB_HOST=.*/DB_HOST=mysql/' .env
sed -i.bak 's/DB_PORT=.*/DB_PORT=3306/' .env
sed -i.bak 's/DB_DATABASE=.*/DB_DATABASE=team_management/' .env
sed -i.bak 's/DB_USERNAME=.*/DB_USERNAME=laravel/' .env
sed -i.bak 's/DB_PASSWORD=.*/DB_PASSWORD=secret/' .env
rm -f .env.bak

echo "Building Docker containers..."
docker compose build

echo "Starting Docker containers..."
docker compose up -d mysql

echo "Waiting for MySQL to be ready..."
sleep 10

docker compose up -d app nginx

echo "Installing Composer dependencies..."
docker compose exec -T app composer install --no-interaction

echo "Generating application key..."
docker compose exec -T app php artisan key:generate

echo "Running database migrations..."
docker compose exec -T app php artisan migrate --force

echo "Seeding the database..."
docker compose exec -T app php artisan db:seed --force

echo "Building frontend assets..."
docker compose run --rm node

echo ""
echo "Setup complete!"
echo "The application is now running at: http://localhost:8000"
echo ""
echo "Default credentials:"
echo "  Email: admin@example.com"
echo "  Password: password"

