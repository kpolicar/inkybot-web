# =============================================================================
# Stage 1: Build frontend assets
# =============================================================================
FROM node:14-alpine AS node-builder

WORKDIR /build

COPY package.json package-lock.json webpack.mix.js tailwind.config.js ./

RUN npm ci

COPY resources/ resources/
COPY public/ public/

RUN npm run production

# =============================================================================
# Stage 2: Install PHP dependencies
# =============================================================================
FROM php:7.4-cli-alpine AS composer-builder

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache git unzip \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    libxml2-dev oniguruma-dev zlib-dev libzip-dev icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd zip mbstring xml bcmath pcntl

WORKDIR /build

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist

COPY . .

# =============================================================================
# Stage 3: Production PHP-FPM image
# =============================================================================
FROM php:7.4-fpm-alpine AS production

RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    zlib-dev \
    libzip-dev \
    icu-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        xml \
        gd \
        bcmath \
        opcache \
        pcntl \
        zip

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-custom.ini

WORKDIR /var/www/html

# Copy composer dependencies
COPY --from=composer-builder /build/vendor/ vendor/

# Copy application source
COPY . .

# Copy built frontend assets
COPY --from=node-builder /build/public/js/ public/js/
COPY --from=node-builder /build/public/css/ public/css/
COPY --from=node-builder /build/public/fonts/ public/fonts/
COPY --from=node-builder /build/public/mix-manifest.json public/mix-manifest.json

# Set permissions
RUN chown -R www-data:www-data storage/ bootstrap/cache/ \
    && chmod -R 775 storage/ bootstrap/cache/

# Copy and prepare entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
