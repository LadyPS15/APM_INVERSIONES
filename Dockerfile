FROM php:8.1-apache

# Instalar dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Cambiar el puerto de Apache a 8080
RUN sed -i 's/80/8080/' /etc/apache2/ports.conf
RUN sed -i 's/80/8080/' /etc/apache2/sites-available/000-default.conf

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código de la aplicación al contenedor
COPY . /var/www/html

# Dar permisos necesarios
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 8080 para que sea accesible
EXPOSE 8080

# Instalar dependencias de composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Ejecutar los comandos de Laravel (cache, rutas, vistas, etc.)
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan migrate --force \
    && php artisan db:seed --force

# Comando para ejecutar Apache en primer plano
CMD ["apache2-foreground"]
