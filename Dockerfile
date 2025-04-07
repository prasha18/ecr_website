# Use the official PHP with Apache image
FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy project files to the Apache root directory
COPY . /var/www/html/

# Remove the default Apache virtual host configuration
RUN rm -f /etc/apache2/sites-enabled/000-default.conf

# Copy apache files to the Apache config directory
COPY 000-default.conf /etc/apache2/sites-enabled/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Add Listen directives for ports 90 and 70
RUN echo "Listen 90" >> /etc/apache2/ports.conf && \
    echo "Listen 100" >> /etc/apache2/ports.conf

# Expose Apache port
EXPOSE 90

# Start Apache in the foreground
CMD ["apache2-foreground"]

