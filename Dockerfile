# Tells the image to use the latest version of PHP
FROM php:apache

# Update the image to the latest packages
RUN apt-get update && apt-get upgrade -y

# Install any needed packages specified in requirements.txt
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Copy the current directory contents into the container at /var/www/html
ADD . /var/www/html

# Create the public/img folder if it doesn't exist
RUN mkdir -p /var/www/html/public/img

# Set permissions for the public/img folder to allow Apache (www-data) to write to it
RUN chown -R www-data:www-data /var/www/html/public/img && \
    chmod -R 777 /var/www/html/public/img

# Copy the apache configuration file to the sites-available directory
# COPY ./app/my-site.conf /etc/apache2/sites-available/my-site.conf

# Set PHP upload limits
RUN echo "upload_max_filesize=256M" > /usr/local/etc/php/conf.d/01-uploads.ini \
    && echo "post_max_size=256M" >> /usr/local/etc/php/conf.d/01-uploads.ini

# Add the environment variables to the apache configuration
RUN echo 'SetEnv DB_HOST ${DB_HOST}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv DB_NAME ${DB_NAME}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv DB_USER ${DB_USER}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv DB_PASS ${DB_PASS}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv PRODUCTION ${PRODUCTION}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv SITE_URL ${SITE_URL}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
    a2enmod rewrite &&\
    a2enmod headers &&\
    a2enmod rewrite &&\
    # a2dissite 000-default &&\
    # a2ensite my-site &&\
    service apache2 restart

# Expose the port the app runs in
EXPOSE 80
