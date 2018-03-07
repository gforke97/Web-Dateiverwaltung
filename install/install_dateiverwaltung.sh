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
           CentOS)
                 PACKAGEMANAGER="yum"
                 func_yum
                 ;;
           arch)
                 PACKAGEMANGER="pacman"
                 func_pacman
                 ;;
           *)
                 echo "ERROR: Your Distribution is not supported by this installation script! Please use a supported distribution"
                 exit 2
                 ;;
esac

}

func_apt-get() {
           apt-get install -y $PACKAGES
}

func_yum() {
           yum install $PACKAGES
}

func_pacman() {
           pacmam -S $PACKAGES
}


func_root
func_selectDistro
func_selectPackageManger

continue through installations

wget -O /tmp/master.zip https://github.com/gforke97/Web-Dateiverwaltung/archive/master.zip
unzip -o /tmp/master.zip -d /tmp/web-dateiverwaltung/
mv -f /tmp/web-dateiverwaltung/*/* /var/www/html/
rm -rf /tmp/master.zip
rm -rf /tmp/web-dateiverwaltung/
