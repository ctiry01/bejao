FROM debian:9

RUN apt-get update && apt-get upgrade -y

RUN apt -y install unzip wget lsb-release apt-transport-https ca-certificates && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php8.0.list
RUN apt-get update
RUN apt install build-essential -y --no-install-recommends
RUN apt install make

RUN apt install -y php8.0 php8.0-curl php8.0-common php8.0-cli php8.0-mysql php8.0-mbstring php8.0-fpm php8.0-xml php8.0-zip php8.0-dom php8.0-gmp php8.0-gd php8.0-sqlite

WORKDIR ~
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN mv composer.phar /usr/local/bin/composer
RUN php -r "unlink('composer-setup.php');"

RUN mkdir /app

WORKDIR /app

COPY run.sh /run.sh
RUN chmod +x /run.sh

RUN mkdir /appcache
RUN chmod 777 /appcache

ENV CACHE_PATH "/appcache"

EXPOSE 8000

CMD ['run.sh']
