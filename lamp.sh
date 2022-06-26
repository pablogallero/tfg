#!/bin/bash

#Variables
USER="root

echo -e "\n--- Instalando ahora... ---\n"

echo -e "\n--- Actualizando paquetes... ---\n"
apt-get update
apt-get upgrade

echo -e "\n--- Instalando Apache... ---\n"

apt-get install apache2 
a2enmod rewrite
service apache2 restart

echo -e "\n--- Instalando MySql Server y Cliente... ---\n"
apt-get install mysql-server mysql-cliente
mysql_secure_installation


echo -e "\n--- Instalando php... ---\n"
apt-get install php5 php5-mysql libapache2-mod-php5
service apache2 restart

	