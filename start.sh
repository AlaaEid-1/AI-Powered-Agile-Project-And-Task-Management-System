#!/usr/bin/env bash

# Use Render's PORT environment variable, defaulting to 80 if not set
PORT=${PORT:-80}

# Update Apache configuration dynamically at runtime
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Execute the primary process (Apache) in the foreground
exec apache2-foreground
