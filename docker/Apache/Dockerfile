FROM php:8.1-apache

COPY ebanx.local.conf /etc/apache2/sites-available/

RUN a2ensite ebanx.local && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN apt-get update && apt-get install -y \
        libpng-dev \
        libonig-dev \
        libzip-dev \
        zlib1g-dev \
        tzdata \
        python3 \
        python3-reportlab \
        libcairo2-dev \
        libgif-dev \
    && docker-php-ext-install calendar pdo_mysql mysqli zip gd 
 
RUN docker-php-ext-install pdo_mysql mysqli

RUN echo "www-data ALL=NOPASSWD: /usr/bin/php, /usr/bin/python3" >> /etc/sudoers

RUN apt-get update && apt-get install -y libzip-dev zlib1g-dev \
    && docker-php-ext-install zip gd
    
ENV APACHE_RUN_USER mariana
RUN useradd -d /var/www --uid=1000 --group=www-data -s /sbin/nologin mariana
