FROM ubuntu:16.04

# Performance optimization - see https://gist.github.com/jpetazzo/6127116
# this forces dpkg not to call sync() after package extraction and speeds up install
RUN echo "force-unsafe-io" > /etc/dpkg/dpkg.cfg.d/02apt-speedup
# we don't need an apt cache in a container
RUN echo "Acquire::http {No-Cache=True;};" > /etc/apt/apt.conf.d/no-cache

RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update; exit 0

RUN apt-get update && \
    apt-get install -y --allow-unauthenticated \
        nginx \
        curl \
        git \
        ssh \
        htop \
        mc \
        supervisor \
        memcached \
        php-memcache \
        php-imagick \
        php7.3-bcmath \
        php7.3-cli \
        php7.3-fpm \
        php7.3-pdo \
        php7.3-pdo-pgsql \
        php7.3-pgsql \
        php7.3-curl \
        php7.3-gd \
        php7.3-iconv \
        php7.3-intl \
        php7.3-json \
        php7.3-mbstring \
        php7.3-xml \
        php7.3-phar && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*; exit 0

# Initialize application
WORKDIR /app

# Install composer && global asset plugin (Yii 2.0 requirement)
ENV COMPOSER_HOME /root/.composer
ENV PATH /root/.composer/vendor/bin:$PATH
ADD .docker/app/auth.json /root/.composer/auth.json
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    /usr/local/bin/composer global require "fxp/composer-asset-plugin"

ENV TERM xterm

# Configure nginx
ADD .docker/app/nginx/site.conf /etc/nginx/sites-available/site
RUN ln -s /etc/nginx/sites-available/site /etc/nginx/sites-enabled/site
RUN rm /etc/nginx/sites-enabled/default
RUN echo "daemon off;" >> /etc/nginx/nginx.conf && \
    echo "cgi.fix_pathinfo = 0;" >> /etc/php/7.3/fpm/php.ini && \
    sed -i.bak 's/variables_order = "GPCS"/variables_order = "EGPCS"/' /etc/php/7.3/fpm/php.ini && \
    sed -i.bak '/;catch_workers_output = yes/ccatch_workers_output = yes' /etc/php/7.3/fpm/pool.d/www.conf && \
    sed -i.bak 's/log_errors_max_len = 1024/log_errors_max_len = 65536/' /etc/php/7.3/fpm/php.ini

# forward request and error logs to docker log collector
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# /!\ DEVELOPMENT ONLY SETTINGS /!\
# Running PHP-FPM as root, required for volumes mounted from host
RUN sed -i.bak 's/user = www-data/user = root/' /etc/php/7.3/fpm/pool.d/www.conf && \
    sed -i.bak 's/group = www-data/group = root/' /etc/php/7.3/fpm/pool.d/www.conf && \
    sed -i.bak 's/--fpm-config /-R --fpm-config /' /etc/init.d/php7.3-fpm
# /!\ DEVELOPMENT ONLY SETTINGS /!\


ADD .docker/app/run.sh /root/run.sh
RUN chmod 775 /root/run.sh

RUN usermod -u 1000 www-data

COPY . /app
# Initialize application
WORKDIR /app

RUN composer install

CMD ["/root/run.sh"]
EXPOSE 80
