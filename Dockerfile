FROM mariadb:latest

ENV MYSQL_ROOT_PASSWORD=passsword
ENV MYSQL_DATABASE=mvc
ENV MYSQL_USER=admin
ENV MYSQL_PASSWORD=password

#COPY init.sql /docker-entrypoint-initdb.d/

EXPOSE 3306
