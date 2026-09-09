#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Caching config..."
php artisan config:cache
php artisan route:cache

echo "Starting Apache..."
exec apache2-foreground