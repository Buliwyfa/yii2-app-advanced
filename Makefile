ROOT_DIR = $(shell pwd)

PHP_CMD_PREFIX = 
NGINX_CMD_PREFIX = 

PREFIX_DOCKER_PHP_FPM = docker exec y2aa_php_fpm
PREFIX_DOCKER_NGINX = docker exec y2aa_nginx

USE_DOCKER = 0

.DEFAULT_GOAL := help

ifeq ($(docker), 1)
	PHP_CMD_PREFIX = $(PREFIX_DOCKER_PHP_FPM)
	NGINX_CMD_PREFIX = $(PREFIX_DOCKER_NGINX)
	USE_DOCKER = 1
endif

# general
help:
	@echo "Type: make [rule]."
	@echo "Hint: Add parameter 'docker=1' at last to execute on Docker."
	@echo ""
	@echo "Available options are:"
	@echo ""
	@echo "- help"
	@echo "- clear"
	@echo "- nginx-reload"
	@echo "- requirements"
	@echo ""
	@echo "- migrate-db"
	@echo "- migrate-db-test"
	@echo ""
	@echo "- docker-compose-start"
	@echo "- docker-compose-stop"
	@echo "- docker-compose-start-console"
	@echo "- docker-compose-rebuild"
	@echo ""
	@echo "- config-env-development"
	@echo "- config-env-production"
	@echo ""
	@echo "- composer-install"
	@echo "- composer-update"
	@echo "- composer-outdated"
	@echo "- composer-show"
	@echo "- composer-clear-cache"
	@echo ""
	@echo "- test"
	@echo ""

clear:
	rm -rf backend/runtime/*
	rm -rf frontend/runtime/*
	rm -rf common/runtime/*
	rm -rf ws/runtime/*

	rm -rf backend/web/assets/*
	rm -rf frontend/web/assets/*
	rm -rf common/web/assets/*

docker-compose-start:
	cd extras/docker && \
	    WWW_DIR=$(ROOT_DIR) docker-compose up -d

docker-compose-start-console:
	cd extras/docker && \
	    WWW_DIR=$(ROOT_DIR) docker-compose up

docker-compose-stop:
	cd extras/docker && \
	    WWW_DIR=$(ROOT_DIR) docker-compose down

docker-compose-rebuild:
	cd extras/docker && \
	    WWW_DIR=$(ROOT_DIR) docker-compose build --force-rm

config-env-development:
	$(PHP_CMD_PREFIX) make clear
	$(PHP_CMD_PREFIX) php init --env=Development --overwrite=All
	$(PHP_CMD_PREFIX) mkdir -p uploads/general

config-env-production:
	$(PHP_CMD_PREFIX) make clear
	$(PHP_CMD_PREFIX) php init --env=Production --overwrite=All
	$(PHP_CMD_PREFIX) mkdir -p uploads/general

migrate-db:
	$(PHP_CMD_PREFIX) php yii migrate --migrationPath=@common/migrations --interactive=0
	$(PHP_CMD_PREFIX) php yii migrate --migrationPath=@backend/migrations --interactive=0
	$(PHP_CMD_PREFIX) php yii migrate --migrationPath=@frontend/migrations --interactive=0
	$(PHP_CMD_PREFIX) php yii migrate --migrationPath=@ws/migrations --interactive=0

migrate-db-test:
	$(PHP_CMD_PREFIX) php yii_test migrate --migrationPath=@common/migrations --interactive=0
	$(PHP_CMD_PREFIX) php yii_test migrate --migrationPath=@backend/migrations --interactive=0
	$(PHP_CMD_PREFIX) php yii_test migrate --migrationPath=@frontend/migrations --interactive=0
	$(PHP_CMD_PREFIX) php yii_test migrate --migrationPath=@ws/migrations --interactive=0

nginx-reload:
	$(NGINX_CMD_PREFIX) service nginx reload

composer-install:
	$(PHP_CMD_PREFIX) composer install

composer-update:
	$(PHP_CMD_PREFIX) composer update

composer-outdated:
	$(PHP_CMD_PREFIX) composer outdated

composer-show:
	$(PHP_CMD_PREFIX) composer show -l

composer-clear-cache:
	$(PHP_CMD_PREFIX) composer clear-cache

test:
	$(PHP_CMD_PREFIX) composer validate
	$(PHP_CMD_PREFIX) vendor/bin/codecept run

requirements:
	$(PHP_CMD_PREFIX) php requirements.php
