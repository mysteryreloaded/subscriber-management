FROM php:8.1-fpm

# Copy composer.lock and composer.json into the working directory
COPY composer.lock composer.json /var/www/
COPY package.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies for the operating system software
RUN apt-get -y update && apt-get -y upgrade && apt-get install -y sudo curl
RUN curl -sL https://deb.nodesource.com/setup_18.x | sudo -E bash -
RUN apt update -y && apt-get install -y \
build-essential \
libpng-dev \
libsqlite3-dev \
libjpeg62-turbo-dev \
libfreetype6-dev \
locales \
zip \
jpegoptim optipng pngquant gifsicle \
vim \
libzip-dev \
unzip \
git \
libonig-dev \
nodejs 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
RUN docker-php-ext-install pdo_sqlite mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents to the working directory
COPY . /var/www

# Assign permissions of the working directory to the www-data user
#RUN chown -R www-data:www-data \
#/var/www/var/storage \
#/var/www/var/log

RUN cd /var/www && \
    composer install && \
    npm install && \
    npm run build

# Expose port 9004 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9004