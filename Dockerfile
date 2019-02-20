FROM wordpress:latest

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN sed -i 's/post_max_size = 8M/post_max_size = 50M/' /usr/local/etc/php/php.ini
RUN sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/' /usr/local/etc/php/php.ini

ADD ./plugins /var/www/html/wp-content/
ADD ./themes /var/www/html/wp-content/
ADD ./uploads /var/www/html/wp-content/

