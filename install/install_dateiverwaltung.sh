#!/usr/bin/env bash
#

PACKAGES="apache2 php7.0"

func_selectDistro() {
     DISTRO= cat /etc/*-release | grep "^ID_LIKE=" | grep -E -o "[a-z]\w+"
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
           RHEL)
                 PACKAGEMANAGER="up2date"
                 func_up2date
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

func_up2date() {
           up2date -i
}

func_root
func_selectDistro
func_selectPackageManger

continue through installations

wget /tmp/ https://github.com/gforke97/Web-Dateiverwaltung/archive/master.zip
unzip /tmp/master.zip /var/www/html