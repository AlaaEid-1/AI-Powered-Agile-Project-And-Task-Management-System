#!/usr/bin/env bash

# Use Render's PORT environment variable, defaulting to 80 if not set
PORT=${PORT:-80}

# Update Apache configuration dynamically at runtime
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Run Laravel migrations
echo "Running Laravel migrations..."
php artisan migrate:fresh --force
# Clear and rebuild Laravel cache (optional but recommended)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute Apache in foreground
echo "Starting Apache..."
exec apache2-foreground
