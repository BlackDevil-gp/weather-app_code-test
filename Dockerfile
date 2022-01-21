FROM php:8.1-cli
COPY . /usr/src/weather_app
WORKDIR /usr/src/weather_app
CMD [ "php", "./index.php" ]