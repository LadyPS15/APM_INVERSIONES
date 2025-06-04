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

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código de la aplicación al contenedor
COPY . /var/www/html

# Dar permisos necesarios
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para que sea accesible
EXPOSE 80

# Comando para ejecutar Apache en primer plano
CMD ["apache2-foreground"]
