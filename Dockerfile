FROM php:8.0-fpm

# Set Timezone
ENV TZ=Asia/Bangkok
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    # mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    nodejs \
    npm \
    curl \
    python2 supervisor \
    libzip-dev \
    cron

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install bcmath pdo_mysql exif pcntl zip
RUN docker-php-ext-configure  gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Set application directory permissions
RUN chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache

COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/crontab/root /etc/crontabs/root
RUN touch /var/log/cron.log

# Prepare script for start service
COPY docker/start-container /usr/local/bin/start-container
RUN chmod u+x /usr/local/bin/start-container

# Change current user to www
USER root

RUN crontab /etc/crontabs/root

# Expose port 9000 and start php-fpm server
EXPOSE 9000

# CMD ["php-fpm"]
ENTRYPOINT ["start-container"]
