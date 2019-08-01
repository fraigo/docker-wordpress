export TIMESTAMP=$(date +%Y%m%d.%H%M%S)
export FILENAME=backups/backup.$TIMESTAMP.sql
export FILENAME_BASE=backups/backup.sql
echo "Backup database $FILENAME"
mysqldump -u root -p$MYSQL_ROOT_PASSWORD --opt --complete-insert wordpress > /root/data/$FILENAME
cp /root/data/$FILENAME /root/data/$FILENAME_BASE
mysqldump -u root -p$MYSQL_ROOT_PASSWORD --skip-opt --complete-insert wordpress > /root/data/backups/wp1.sql
grep "INSERT INTO \`" /root/data/backups/wp1.sql > /root/data/backups/wp.sql
rm /root/data/backups/wp1.sql
replace "INSERT INTO \`" "REPLACE INTO \`" -- /root/data/backups/wp.sql
