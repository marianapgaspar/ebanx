BASEDIR=$(dirname "$0")
sudo docker network create --subnet 172.30.0.0/16 ebanx_net
sudo docker build -t ebanx/server ${BASEDIR}/Apache
sudo docker rm -f ebanx.local
sudo docker rm -f mysql.local
sudo docker rm -f ngrok.local
sudo docker run -d --name ebanx.local --ip=172.30.0.2 -p 80:80 --net ebanx_net -itd -v /home/mariana/Documentos/Projetos/ebanx:/var/www/html ebanx/server
sudo docker run -d --name mysql.local --ip=172.30.0.3 -p 3306:3306 --net ebanx_net -v /var/opt/mysql/:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=toor -d mysql --default-authentication-plugin=mysql_native_password --sql_mode=""
sudo docker run -d --name ngrok.local --ip=172.30.0.4 --net ebanx_net -itd -e NGROK_AUTHTOKEN=2eYLFIbBBkjzkaKEPSe8mOArfvO_4pcffjNjPRXmibvttj5Kz ngrok/ngrok:latest http 172.30.0.2:80