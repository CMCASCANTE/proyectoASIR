cd DockerServices
docker-compose up -d
cd ../DockerLogs
docker-compose up -d






# importacion de dashboards y templates
#docker exec dockerlogs_metricbeat_1 ./metricbeat setup -e -E output.logstash.enabled=false -E output.elasticsearch.hosts=['172.27.0.100:9200'] -E setup.kibana.host=http://192.168.1.2:5601
#docker exec dockerlogs_filebeat_1 ./filebeat setup -e -E output.logstash.enabled=false -E output.elasticsearch.hosts=['172.27.0.100:9200'] -E setup.kibana.host=http://192.168.1.2:5601
#docker exec dockerlogs_packetbeat_1 ./packetbeat setup -e -E output.logstash.enabled=false -E output.elasticsearch.hosts=['172.27.0.100:9200'] -E setup.kibana.host=http://192.168.1.2:5601
#docker exec dockerlogs_auditbeat_1 ./auditbeat setup -e -E output.logstash.enabled=false -E output.elasticsearch.hosts=['172.27.0.100:9200'] -E setup.kibana.host=http://192.168.1.2:5601



# docker exec dockerlogs_metricbeat_1 ./metricbeat setup -e -E output.logstash.enabled=false -E output.elasticsearch.hosts=['172.27.0.3:9200'] -E setup.kibana.host=http://10.0.2.100:5601
