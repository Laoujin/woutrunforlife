FROM php:7.4-cli

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

EXPOSE 8080

VOLUME /app
WORKDIR /app

CMD [ "php", "-S", "0.0.0.0:8080" ]
