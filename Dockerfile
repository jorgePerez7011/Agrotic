FROM node:20 AS frontend-build

WORKDIR /app

# Copy only the package manifests first so npm install is cached
# independently of source changes and always resolves dependencies
# (including devDependencies like Bootstrap) from these files.
COPY package.json package-lock.json* ./

# Force devDependencies to be installed even if NODE_ENV=production
# leaks into the build environment, since Bootstrap and the Vite
# tooling are declared as devDependencies in package.json.
RUN npm install --include=dev

# Copy the rest of the project files after dependencies are installed
# so npm install layers stay cached across unrelated source changes.
COPY . .

RUN npm run build

FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev curl libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd bcmath zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

COPY --from=frontend-build /app/public/build /var/www/html/public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

RUN chown -R www-data:www-data /var/www/html \
    && mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]