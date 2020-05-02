FROM docker.elastic.co/beats/packetbeat:7.6.2

# SSL
USER root
RUN mkdir /usr/share/packetbeat/SSL

# Copiar el archivo de configuracion
COPY packetbeat.yml /usr/share/packetbeat/packetbeat.yml

