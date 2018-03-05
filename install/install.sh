#!/bin/bash
# Program:
#   Installer for the Web Dateiverwaltung project
# History:
# 05.03.2018 webdateiverwaltung First release.

# If apt-get is installed, then we know it's part of the Debian family
if command -v apt-get &> /dev/null; then
	apt-get install apache2 -y
	apt-get install php7.0 -y

cd /var/www/html
git clone https://github.com/gforke97/Web-Dateiverwaltung/

wget /tmp/ https://github.com/gforke97/Web-Dateiverwaltung/archive/master.zip
unzip /tmp/master.zip /var/www/html