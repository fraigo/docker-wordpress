Docker/Wordpress for Development
========================


## Containers

* `db` Mysql5.7
* `wordpress` Wordpress @ `http://localhost:8000`
* `myadmin` PhpMyAdmin @ `http://localhost:8002`

## Commands

### Services

* `npm run start` to start the environment
* `npm run stop` to stop the environment
* `npm run reset` to re-create the environment (new wordpress installation)

### Wordpress 

* `npm run wordpress` to open the Wordpress site @ `http://localhost:8000`

### Database administration
* `npm run phpmyadmin` to open the PhpMyAdmin site @ `http://localhost:8002`
* `npm run dbconsole` to open a Bash console from the mysql server
* `npm run query "sqlquery"` to run a SQL query in mysql server
* `npm run backup` to run a SQL query in mysql server









