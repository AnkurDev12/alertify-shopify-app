#!/usr/bin/env bash
echo "Running composer"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"

# Install dependencies
composer install --no-dev --optimize-autoloader

echo "generating application key..."
php artisan key:generate --show

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

# Ensure Node.js and npm are installed
echo "Checking Node.js and npm installation..."
node -v
npm -v

# If Node.js or npm are not installed, you might need to add installation commands here,
# tailored to your deployment environment. For instance, you could use:
# curl -sL https://deb.nodesource.com/setup_16.x | bash -
# apt-get install -y nodejs

# Install JavaScript dependencies and build assets with Vite
echo "Installing npm dependencies and building assets..."
npm install
npm run build