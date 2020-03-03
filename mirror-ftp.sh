source ./config-ftp.sh
cd uploads
echo "Downloading 'uploads'..."
wget -m -nH --cut-dirs=2 -o /tmp/mirror-uploads.log --ftp-user=$FTP_USER --ftp-password=$FTP_PASS ftp://$FTP_HOST/wp-content/uploads ./ 
echo "Done"
cd ..
cd plugins
echo "Downloading 'plugins'"
wget -m -nH --cut-dirs=2 -o /tmp/mirror-plugins.log --ftp-user=$FTP_USER --ftp-password=$FTP_PASS ftp://$FTP_HOST/wp-content/plugins ./
echo "Done"
cd ..