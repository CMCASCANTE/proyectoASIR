#!/bin/bash
# Instalacion de paquetes
curl -L -o /tmp/beatInstall-metric.deb -O https://artifacts.elastic.co/downloads/beats/metricbeat/metricbeat-7.6.2-amd64.deb
dpkg -i /tmp/beatInstall-metric.deb
curl -L -o /tmp/beatInstall-file.deb -O https://artifacts.elastic.co/downloads/beats/filebeat/filebeat-7.6.2-amd64.deb
dpkg -i /tmp/beatInstall-file.deb
curl -L -o /tmp/beatInstall-packet.deb -O https://artifacts.elastic.co/downloads/beats/packetbeat/packetbeat-7.6.2-amd64.deb
dpkg -i /tmp/beatInstall-packet.deb

# Configuracion de Beats
# metricbeat
mkdir /etc/metricbeat/SSL
cp -r ./SSL /etc/metricbeat
cp metricbeat.yml /etc/metricbeat/metricbeat.yml
# filebeat
mkdir /etc/filebeat/SSL
cp -r ./SSL /etc/filebeat
cp filebeat.yml /etc/filebeat/filebeat.yml
# packetbeat
mkdir /etc/packetbeat/SSL
cp -r ./SSL /etc/packetbeat
cp packetbeat.yml /etc/packetbeat/packetbeat.yml

# Levantar servicios 
systemctl enable packetbeat metricbeat filebeat
systemctl start packetbeat metricbeat filebeat


# limpiar archivos de instalacion
rm /tmp/beatInstall*
