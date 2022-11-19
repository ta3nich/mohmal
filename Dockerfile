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
RUN chmod -R a+r /usr/local/bin/start
RUN echo "ServerName 10.220.35.226" >> /etc/apache2/apache2.conf
RUN cat /etc/apache2/apache2.conf
#RUN service apache2 restart
EXPOSE 443 80 8080

#CMD ["php" "-a"]
RUN echo "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj"
RUN service --status-all
#CMD ["start"]
RUN echo "j0000000000000000000000"

#CMD ["apache2-foreground"]




