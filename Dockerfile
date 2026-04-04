# -------------------------------
# Base Image
# -------------------------------
FROM php:7.4-apache

# -------------------------------
# Install dependencies for IMAP
# -------------------------------
RUN apt-get update && \
    apt-get install -y \
        libc-client-dev \
        libkrb5-dev \
        unzip \
        git \
        libssl-dev \
        && rm -rf /var/lib/apt/lists/*

# -------------------------------
# Enable IMAP extension
# -------------------------------
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install -j$(nproc) imap

# -------------------------------
# Copy application code
# -------------------------------
COPY src/ /var/www/html/

# -------------------------------
# Set permissions for web files
# -------------------------------
RUN chown -R www-data:www-data /var/www/html/ && \
    find /var/www/html/ -type d -exec chmod 755 {} \; && \
    find /var/www/html/ -type f -exec chmod 644 {} \;

# -------------------------------
# Fix HTMLPurifier cache folder
# -------------------------------
RUN mkdir -p /var/www/html/vendor/ezyang/htmlpurifier/library/HTMLPurifier/DefinitionCache/Serializer && \
    chown -R www-data:www-data /var/www/html/vendor/ezyang/htmlpurifier/library/HTMLPurifier/DefinitionCache/Serializer && \
    chmod 755 /var/www/html/vendor/ezyang/htmlpurifier/library/HTMLPurifier/DefinitionCache/Serializer

# -------------------------------
# Copy custom start script (optional)
# -------------------------------
COPY start /usr/local/bin/
RUN chmod a+x /usr/local/bin/start

# -------------------------------
# Configure Apache
# -------------------------------
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Limit concurrent connections to avoid exhausting IMAP connection limit
RUN echo '<IfModule mpm_prefork_module>\n\
    StartServers 2\n\
    MinSpareServers 2\n\
    MaxSpareServers 5\n\
    MaxRequestWorkers 10\n\
    MaxConnectionsPerChild 0\n\
</IfModule>' > /etc/apache2/conf-available/mpm_limits.conf && \
    a2enconf mpm_limits

# Enable Apache modules if needed
RUN a2enmod rewrite

# -------------------------------
# Expose ports
# -------------------------------
EXPOSE 80 443 8080

# -------------------------------
# Start Apache in foreground
# -------------------------------
CMD ["/usr/sbin/apache2ctl", "-DFOREGROUND"]
