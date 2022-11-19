FROM php:7.4-apache
RUN apt-get update && \
    apt-get install -y \
        libc-client-dev libkrb5-dev && \
    rm -r /var/lib/apt/lists/*
    
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install -j$(nproc) imap
COPY src/ /var/www/html/
RUN chmod -R a+r /var/www/html/

COPY start /usr/local/bin/
#RUN service apache2 restart
EXPOSE 443 80 8080
RUN systemctl reload apache2
#CMD ["php" "-a"]
CMD ["start"]



