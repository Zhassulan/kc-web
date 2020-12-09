FROM php:7-apache
RUN docker-php-ext-install mysqli
ENV TZ Asia/Almaty
COPY www-data /var/www/html
COPY config/php.ini /usr/local/etc/php/php.ini
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

