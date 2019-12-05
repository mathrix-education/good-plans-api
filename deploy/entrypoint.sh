#!/bin/ash
# Get port from environment variable (Cloud Run implementation)
PORT_FROM_ENV=$(printenv PORT)
PORT=${PORT_FROM_ENV:-"8080"}
sed -i -E "s/CLOUD_RUN_PORT/${PORT}/g" /etc/nginx/nginx.conf

# Start PHP-FPM and nginx
/usr/sbin/php-fpm7 && /usr/sbin/nginx -g 'daemon off;'
