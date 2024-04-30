FROM ubuntu:latest

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y nginx-full php php-fpm php-mysql composer
RUN service apache2 stop
RUN apt-get purge -y apache2 # now realy f..k you appace2.
RUN apt-get auto-remove -y

RUN echo 'clear_env = no' >> /etc/php/8.3/fpm/pool.d/www.conf
ADD ./src/www/ /var/www/pt-start
COPY nginx-site.conf /etc/nginx/sites-available/default

EXPOSE 80

ENV TZ=Europe/London
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

CMD /etc/init.d/php8.3-fpm start && nginx -g 'daemon off;'

