export TIMESTAMP=$(date +%Y%m%d.%H%M%S)
export FILENAME=backups/backup.sql
echo "Restoring database $FILENAME"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "source /root/data/$FILENAME" wordpress 
