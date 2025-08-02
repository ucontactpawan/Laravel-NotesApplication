@echo off
php -d extension=pdo_sqlite -d extension=sqlite3 artisan %*
