export TIMESTAMP=$(date +%Y%m%d.%H%M%S)
export FILENAME=backups/backup.$TIMESTAMP.sql
echo "Backup database $FILENAME"
mysqldump -u root -p$MYSQL_ROOT_PASSWORD --opt wordpress > /root/data/$FILENAME
