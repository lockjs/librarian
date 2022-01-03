FROM php:8.0-cli AS default

WORKDIR /opt

CMD ["php", "-S 0.0.0.0:8080", "-t ./web"]

FROM default AS development
# Install additional dependancies
#   - unzip, required for composer
RUN apt-get update && \
    apt-get -y install --no-install-recommends \
      unzip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install additional PHP extensions
RUN docker-php-source extract && \
    pecl install \
      xdebug && \
    docker-php-source delete

# Copy composer binary from offical image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Configure xdebug
RUN \
  echo "zend_extension=xdebug" >> /usr/local/etc/php/conf.d/xdebug-local.ini && \
  echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug-local.ini && \
  echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug-local.ini && \
  echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug-local.ini

# Include binaries installed from `composer` in the PATH
ENV PATH="./vendor/bin:${PATH}"
