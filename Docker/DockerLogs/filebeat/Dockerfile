FROM docker.elastic.co/beats/filebeat:7.6.2

# Copiar el archivo de configuracion
COPY filebeat.yml /usr/share/filebeat/filebeat.yml

USER root

# creacion de directorios
RUN mkdir /usr/share/filebeat/hostlogs
RUN mkdir /usr/share/filebeat/dockerlogs
RUN mkdir /usr/share/filebeat/apachelogs
RUN chown -R root /usr/share/filebeat/
RUN chmod -R go-w /usr/share/filebeat/

# SSL
RUN mkdir /usr/share/filebeat/SSL

# activar modulo apache
RUN filebeat modules enable apache
