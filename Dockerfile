# Используем PHP 8.2
FROM php:8.2-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    zip \
    libonig-dev \
    libpq-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Устанавливаем расширение MongoDB
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/symfony

# Копируем проект
COPY . .

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader

# Устанавливаем права доступа
RUN chown -R www-data:www-data /var/www/symfony

# Используем порт 9000 для PHP-FPM
EXPOSE 9000

# Запускаем PHP-FPM
CMD ["php-fpm"]
