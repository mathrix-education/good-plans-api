FROM alpine:3.10

LABEL Maintainer="Mathieu Bour <mathieu@mathrix.fr>" \
      Description="Base container for Lumen APIs base on nginx and PHP 7.3"

RUN apk --no-cache add php7 php7-fpm php7-curl php7-dom php7-fileinfo php7-gd php7-gmp php7-intl \
    php7-json php7-mbstring php7-opcache php7-pdo_mysql php7-phar php7-xml php7-zlib php7-zip \
    nginx

# Configure nginx
COPY deploy/nginx.conf /etc/nginx/nginx.conf
# Potential security flaw
RUN chmod -R 0777 /etc/nginx/

# Remove default server definition
RUN rm /etc/nginx/conf.d/default*

# Configure PHP-FPM
COPY deploy/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY deploy/php.ini /etc/php7/php.ini

# Setup document root
RUN mkdir -p /var/www

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /run && \
    chown -R nobody.nobody /var/lib/nginx && \
    chown -R nobody.nobody /var/tmp/nginx && \
    chown -R nobody.nobody /var/log/nginx && \
    chown -R nobody.nobody /var/www

# Add entrypoint
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Switch to use a non-root user from here on
USER nobody

WORKDIR /var/www

COPY --chown=nobody . /var/www/

RUN php artisan providers:cache -f && \
    rm -rf deploy/ && \
    rm -rf /var/cache/apk/*

ENTRYPOINT ["/entrypoint.sh"]
