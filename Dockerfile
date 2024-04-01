# Build stage for Node.js
FROM node:18 AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Start from the richarvey/nginx-php-fpm base image
FROM richarvey/nginx-php-fpm:2.0.0

# Copy the Laravel application code into the image
COPY . /var/www/html

# Set environment variables for image configuration
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Set environment variables for Laravel configuration
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# If not skipping Composer, install PHP dependencies (uncomment the next line if needed)
# RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# Copy the built assets from the Node.js stage
COPY --from=node_builder /app/public /var/www/html/public

CMD ["/start.sh"]
