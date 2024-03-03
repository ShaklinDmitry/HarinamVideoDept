FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies


RUN apt-get update \
    && apt-get install -y gnupg curl wget ca-certificates unzip lsb-release \
    && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - \
    && echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" | tee  /etc/apt/sources.list.d/pgdg.list \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        nano \
        supervisor \
        sudo

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions

RUN docker-php-ext-install mbstring exif pcntl bcmath gd sockets zip
RUN docker-php-ext-install pgsql pdo_pgsql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#COPY ./laravel-worker.conf "/etc/supervisor/conf.d/"
#COPY ./laravel-worker2.conf "/etc/supervisor/conf.d/"

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
