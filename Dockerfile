FROM php:8.4-cli

# Install system packages + Node.js
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    zip \
    nodejs \
    npm

RUN docker-php-ext-install zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# SQLite setup
RUN mkdir -p /app/database \
    && touch /app/database/database.sqlite

# Install PHP dependencies
RUN composer install

# Install frontend dependencies
RUN npm install

# Build Vite assets
RUN npm run build

# Clear Laravel cache
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan route:clear
RUN php artisan view:clear

# Run migrations
RUN php artisan migrate --force

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]