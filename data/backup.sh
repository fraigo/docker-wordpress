export TIMESTAMP=$(date +%Y%m%d.%H%M%S)
mysqldump -u root -p$MYSQL_ROOT_PASSWORD --opt wordpress > /home/wpdata/backups/backup.$TIMESTAMP.sql
