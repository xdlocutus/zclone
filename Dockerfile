FROM php:8.3-fpm-alpine
RUN apk add --no-cache postgresql-dev nginx && docker-php-ext-install pdo pdo_pgsql pdo_mysql opcache
WORKDIR /var/www/html
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . .
RUN composer install --no-dev --optimize-autoloader || true
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
EXPOSE 8080 8081
CMD ["sh","-c","php-fpm -D && nginx -g 'daemon off;'"]
