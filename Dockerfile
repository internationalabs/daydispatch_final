FROM ubuntu:latest
LABEL authors="yasir"

ENTRYPOINT ["top", "-b"]


FROM php:8.1 as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmatch
