# Use the official PHP image with Apache
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the application files to the container
COPY . .

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli

# Expose the port for Apache
EXPOSE 90

# Start Apache server
CMD ["apache2-foreground"]

