# DEV env: docker-compose

This is a generated README by the [BeCode CLI tool](https://github.com/becodeorg/cli).

If you are completely new to Docker we recommend you to read the [Docker Survival Guide](https://github.com/becodeorg/cli/tree/develop/docs/docker-survival-guide).

## Install `docker` & `docker-compose`

### For macOS

Follow the procedure on [this page](https://docs.docker.com/docker-for-mac/install/)

### For Windows

#### Pro, Enterprise or Education versions

Follow the procedure on [this page](https://docs.docker.com/docker-for-windows/install/)

#### Home version

To use docker on Windows Home, you need to use the [Docker Toolbox](https://docs.docker.com/toolbox/overview/), which use VirtualBox to run docker on your machine.  

##### ⚠️ Important notes for Windows Home version

The Docker Toolbox and the VirtualBox env will change two important things when you use docker : 

1. The host to access the containers isn't `localhost`, but the IP `192.168.99.100` (by default)
2. Due to the nature of VirtualBox, the *volumes* binding between your local system and the containers are kinda limited. Please ensure that **your working folder** is inside the `C:/Users` path.

### For Linux

1. Follow the procedure on [this page](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
1. Run the following command to fix a possible right issue : `sudo usermod -a -G docker $USER`
1. Follow the procedure on [the page](https://docs.docker.com/compose/install/#install-compose)
1. Restart your computer

To test your installation, run the command `docker run hello-world`.

## Run `docker`

When starting your env for the first time, run the following command in yhour repo:

	docker-compose build
	
> **NOTE:** thus you don't need to run this command each time, it may be useful to *re*build your services when you change the configuration of your services.

Then, simply run the following command to get started:

    docker-compose up

The details for all your services is detailed bellow.

## Your services

### Langage: PHP

#### What is PHP?

PHP is a server-side scripting language designed for web development, but which can also be used as a general-purpose programming language. PHP can be added to straight HTML or it can be used with a variety of templating engines and web frameworks. PHP code is usually processed by an interpreter, which is either implemented as a native module on the web-server or as a common gateway interface (CGI).

* **Website:** [php.net](http://php.net)
* **Documentation:** [php.net/docs.php](http://php.net/docs.php)

#### Container

* **Image used:** [library/php:apache](https://hub.docker.com/_/php/)

##### Usage

Place your PHP files in `./src` folder, access it with your browser at address [localhost](http://localhost).


* * *

### Database: MariaDB

#### What is MariaDB?

MariaDB is a community-developed fork of MySQL intended to remain free under the GNU GPL.

* **Website:** [mariadb.org](https://mariadb.org)
* **Documentation:** [mariadb.org/learn](https://mariadb.org/learn/)

#### Container

* **Image used:** [library/mariadb](https://hub.docker.com/_/mariadb/)

##### Usage

> **NOTE:** from dev POV, using MariaDB is strictly the same as using MySQL.

**IMPORTANT:** the first startup of this container is long : the db server needs to be initialized.

**NOTE:** the container don't create a database at startup - create it within your code (or with phpMyAdmin)

###### Access from another container

You can access the database **from another container** with the following informations:

* **host:** `mysql`
* **port:** `3306`
* **user:** `root`
* **pass:** `root`

###### Access from your host

You can access the database  **from you host** with the following informations:

* **host:** `localhost`
* **port:** `3306`
* **user:** `root`
* **pass:** `root`


* * *

### Tools: phpMyAdmin

#### What is phpMyAdmin?

A web interface for MySQL and MariaDB.

* **Website:** [phpmyadmin.net](https://www.phpmyadmin.net/)
* **Documentation:** [phpmyadmin.net/docs](https://www.phpmyadmin.net/docs/)

#### Container

* **Image used:** [phpmyadmin/phpmyadmin](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)

##### Usage

The container is already configured to use the MySQL/MariaDB credentials.  
Access **phpMyAdmin** with your browser at address [localhost:8001](http://localhost:8001).