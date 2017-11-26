######
# See: https://hub.docker.com/_/php/
######

FROM php:7.1.11-fpm
MAINTAINER Paulo Coutinho <paulo@prsolucoes.com>

######
# You can configure php extensions using docker-php-ext-configure
# You can install php extensions using docker-php-ext-install
######

# define timezone
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata
RUN /bin/echo -e "LANG=\"en_US.UTF-8\"" > /etc/default/local

# install dependencies
RUN apt-get update
RUN apt-get install -y build-essential 
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libpng12-dev
RUN apt-get install -y curl
RUN apt-get install -y libcurl3
RUN apt-get install -y libcurl3-dev
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y libicu-dev
RUN apt-get install -y libmemcached-dev 
RUN apt-get install -y mysql-client
RUN apt-get install -y libmagickwand-dev
RUN apt-get install -y unzip

# memcached
RUN pecl install memcached-3.0.4
RUN docker-php-ext-enable memcached

# memcache
RUN cd /tmp \
    && curl -sSL -o memcache-php7.zip https://github.com/websupport-sk/pecl-memcache/archive/php7.zip \
    && unzip memcache-php7 \
    && cd pecl-memcache-php7 \
    && /usr/local/bin/phpize \
    && ./configure --with-php-config=/usr/local/bin/php-config \
    && make \
    && make install \
    && echo "extension=memcache.so" > /usr/local/etc/php/conf.d/ext-memcache.ini \
    && rm -rf /tmp/pecl-memcache-php7 memcache-php7.zip

# install, configure and enable all php packages
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-configure mysqli --with-mysqli=mysqlnd
RUN docker-php-ext-configure intl

RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) mysqli
RUN docker-php-ext-install -j$(nproc) pdo
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install -j$(nproc) curl
RUN docker-php-ext-install -j$(nproc) iconv
RUN docker-php-ext-install -j$(nproc) mcrypt

# install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# install imagick
RUN pecl install imagick
RUN docker-php-ext-enable imagick

# install composer
RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# clean image
RUN apt-get clean