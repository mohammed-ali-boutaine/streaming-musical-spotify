# Use an official PHP image with Apache
FROM php:8.2-apache

# Install necessary PHP extensions for PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the application files
COPY . /var/www/html

# Change Apache DocumentRoot to public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Give correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Restart Apache to apply changes
RUN service apache2 restart

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80
