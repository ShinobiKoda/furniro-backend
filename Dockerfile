FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Enable Apache mod_rewrite for Laravel's pretty URLs
RUN a2enmod rewrite

# Set Apache document root to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Allow .htaccess overrides so Laravel's routing works
# (added AFTER the sed commands above, so this block doesn't get mangled)
RUN printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' >> /etc/apache2/apache2.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first (better layer caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy the rest of the app
COPY . .

RUN composer dump-autoload --optimize

# Permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Render injects a PORT env var — Apache needs to listen on it
ENV PORT=80
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]