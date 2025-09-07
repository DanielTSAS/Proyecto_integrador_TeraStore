# Usamos una imagen oficial de PHP 8.2 con FPM (manejador de procesos de PHP)
FROM php:8.2-fpm

# Argumentos para crear un usuario y no usar 'root' (más seguro)
ARG user=terastore
ARG uid=1000

# Instalar dependencias del sistema y extensiones de PHP que Laravel necesita
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev

# Limpiar cache para que la imagen no sea tan pesada
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar las extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer (el manejador de paquetes de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear un usuario para la aplicación
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /var/www

# Cambiar al usuario que creamos
USER $user