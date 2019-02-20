Docker/Wordpress for Development
========================

A Docker-based Wordpress development environment. Includes:

* Wordpress 5.0  using PHP 7.2.13
* PHPMyAdmin 4.8.4
* Mysql 5.7

## Requirements

* Docker/Docker-compose for running containers
* Node.js/npm for running project commands

## Project Commands

Note: The *Docker service* must be running before trying to start the containers.

### Services

* `npm run start` to start the environment
* `npm run stop` to stop the environment
* `npm run reset` to re-create the environment (new wordpress installation)

### Wordpress 

* `npm run wordpress` to open the Wordpress site @ `http://localhost:8000`

### Database administration
* `npm run phpmyadmin` to open the PhpMyAdmin site @ `http://localhost:8002`
* `npm run dbconsole` to open a Bash console from the mysql server
* `npm run query "sqlquery"` to run a SQL query in mysql server. Example `npm run query "SHOW TABLES"`
* `npm run backup` to create a database backup in `./data/backup/backup.YYYYMMDD.hhmmss.sql`

## Folders

* `data` : To store sql and backup files, and to run database commands (backup)
* `plugins` : Includes a Demo plugin for Wordpress plugin development. Synchronized with `wp-content/plugins`.
* `themes` : Includes a Demo theme for Wordpress theme development. Synchronized with `wp-content/themes`.
* `uploads` : To store files uploaded to the wordpress installation. Synchronized with `wp-content/uploads`.

## Docker-compose

This file contains the current Wordpress services with 3 containers:

* `db` Mysql5.7 using port `3306`
* `wordpress` Wordpress @ `http://localhost:8000`
* `myadmin` PhpMyAdmin @ `http://localhost:8002`










