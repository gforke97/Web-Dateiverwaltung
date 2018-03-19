#!/usr/bin/env bash
#

PACKAGES="apache2 php unzip libapache2-mod-php"

func_selectDistro() {
    if [ -z $(cat /etc/*-release | grep "^ID_LIKE=")]
        then DISTRO=$(cat /etc/*-release | grep "^ID=" | grep -E -o "[a-z]\w+")
        else DISTRO=$(cat /etc/*-release | grep "^ID_LIKE=" | grep -E -o "[a-z]\w+")
    fi
}

func_root() {
  if [ "$EUID" -ne 0 ]
    then echo "Please run as root or use 'sudo ./install_dateiverwaltung'"
    exit
  fi
}

func_selectPackageManger() {
     case "$DISTRO" in
           debian)
                 PACKAGEMANGER="apt-get"
                 func_apt-get
                 ;;
           *)
                 echo "ERROR: Your Distribution is not supported by this installation script! Please use a supported distribution"
                 exit 2
                 ;;
esac

}

func_apt-get() {
           apt-get update
           apt-get install -y ${PACKAGES}
}


func_root
func_selectDistro
func_selectPackageManger

continue through installations

phppath=$(find /etc -name php.ini | grep apache2)
cp $phppath $phppath.old
sed -i 's/post_max_size =.*/post_max_size = 10G/g' $phppath
sed -i 's/upload_max_filesize =.*/upload_max_filesize = 10G/g' $phppath
wget -O /tmp/master.zip https://github.com/gforke97/Web-Dateiverwaltung/archive/master.zip
unzip -o /tmp/master.zip -d /tmp/web-dateiverwaltung/
mkdir /var/www/html/backup-$(date -I)/
mv -f /var/www/html/* /var/www/html/backup-$(date -I)/
mv -f /tmp/web-dateiverwaltung/*/* /var/www/html/
rm -rf /tmp/master.zip
rm -rf /tmp/web-dateiverwaltung/
