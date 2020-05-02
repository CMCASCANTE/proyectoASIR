FROM docker.elastic.co/beats/auditbeat:7.6.2

# Copiar el archivo de configuracion
COPY auditbeat.yml /usr/share/auditbeat/auditbeat.yml

USER root

# creacion de directorios
RUN mkdir /usr/share/auditbeat/containerVuln
RUN chown -R root /usr/share/auditbeat/
RUN chmod -R go-w /usr/share/auditbeat/

# SSL
RUN mkdir /usr/share/auditbeat/SSL


