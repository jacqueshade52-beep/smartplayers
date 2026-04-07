FROM php:8.2-apache

# Installation des extensions PHP nécessaires pour Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Activation du mod rewrite pour Apache
RUN a2enmod rewrite

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers du projet
COPY . .

# Installation des dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Configuration des permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Exposition du port
EXPOSE 8000

# Commande de démarrage
CMD php artisan serve --port=$PORT --host=0.0.0.0