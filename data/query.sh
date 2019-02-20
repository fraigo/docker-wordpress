cd /root
mysql -u root -p$MYSQL_ROOT_PASSWORD wordpress -e "$1 $2 $3 $4"
