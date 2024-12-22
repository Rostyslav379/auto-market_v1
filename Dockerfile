FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    curl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring zip exif pcntl bcmath gd

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

COPY . /var/www/symfony

RUN chown -R www-data:www-data /var/www/symfony

EXPOSE 9000
CMD ["php-fpm"]