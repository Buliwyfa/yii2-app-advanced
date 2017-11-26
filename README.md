# Yii2 App Advanced

This is a simple web system made with Yii2 with advanced features. The project has:
 
- Frontend with Boostrap 3
- Administration panel with AdminLTE
- Secure permission control for backend
- Simple CMS
- Customer areas (login, signup, recovery password, contact)
- Docker-compose configurations (nginx, mysql, php-fpm, memcached)
- Localizations for frontend and backend in english and portuguese
- Mobile, tablet and desktop friendly
- Upload for single file or multiple files configured
- Backend with specific report controller
- Configurations for development and production environment

This project is used in many other projects. It is ready to make a new website.

## Commands

If you type "make" in your terminal, you get all options:

```
- help
- clear
- docker-compose-start
- docker-compose-stop
- config-env-development
- config-env-production
- migrate-db
- nginx-reload
```

If you have installed docker and docker compose, you have ready to use commands to start.

Use the following commands:

```
make docker-compose-start
make config-env-development
make migrate-db
```

All commands inside make use the docker names, like "docker_php-fpm_1". So you can execute "php" or "composer" like this:

```
docker exec -it docker_php-fpm_1 php yii
``` 

or 

```
docker exec -it docker_php-fpm_1 composer install
``` 

With docker you dont need install on your machine MAMP, XAMP or something like this. Docker is everything :p

All project configurations is using "yii2-app-advanced.local" as hosts (nginx and absolute URL in yii2 config files), so add in your "/etc/hosts" file:

```
127.0.0.1 yii2-app-advanced.local
```

## Contact

You can send email to me, to talk about anything related to the project:  
[paulo@prsolucoes.com](paulo@prsolucoes.com)

## Supported By Jetbrains IntelliJ IDEA

![Supported By Jetbrains IntelliJ IDEA](extras/images/jetbrains-logo.png "Supported By Jetbrains IntelliJ IDEA")

## Author WebSite

> http://www.pcoutinho.com

## License

[MIT](http://opensource.org/licenses/MIT)

Copyright (c) 2017-present, Paulo Coutinho