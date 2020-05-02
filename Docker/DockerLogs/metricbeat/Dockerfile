FROM docker.elastic.co/beats/metricbeat:7.6.2

# Copiar el archivo de configuracion
COPY metricbeat.yml /usr/share/metricbeat/metricbeat.yml

USER root
# SSL
RUN mkdir /usr/share/metricbeat/SSL

# indicar la recogida de datos de los volumenes del host
ENTRYPOINT ["metricbeat"]
CMD [ "-e", "-system.hostfs=/hostfs"]
