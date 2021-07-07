FROM ubuntu:latest
ENV DEBIAN_FRONTEND noninteractive
EXPOSE 80
COPY . /app
RUN apt-get update &&\
    apt-get install -y apache2 &&\
    apt-get install -y php &&\
    apt-get install -y mysql-server &&\
    apt-get install -y php-mysqli &&\
    apt-get install -y systemctl &&\
    usermod -d /var/lib/mysql/ mysql &&\
    service mysql start &&\
    rm /var/www/html/index.html &&\
    mysql -e "CREATE DATABASE ktelekom;" &&\
    mysql -e "CREATE USER 'pthon'@'%' IDENTIFIED BY '123456';" &&\
    mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'pthon'@'%' WITH GRANT OPTION;" &&\
    mysql -e "FLUSH PRIVILEGES;" &&\
    mysql ktelekom < /app/dump/ktelekom.sql &&\
    cp -r /app/www/* /var/www/html
CMD service mysql start && service apache2 start && tail -F /var/log/mysql/error.log

    
