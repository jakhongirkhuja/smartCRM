FROM php:8.4-fpm
WORKDIR /var/www/html

# Update package list and install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libgd-dev

# Install PHP extensions
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql
RUN docker-php-ext-install exif
RUN docker-php-ext-install pcntl
RUN docker-php-ext-configure pcntl --enable-pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --2
RUN mv composer.phar /usr/local/bin/composer
