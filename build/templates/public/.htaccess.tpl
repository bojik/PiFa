AddDefaultCharset utf-8
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f [NC]
RewriteCond %{REQUEST_FILENAME} !-d [NC]
RewriteRule .* index.php [NC,QSA,L]