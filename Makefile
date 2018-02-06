ROOT_DIR = $(shell pwd)

.DEFAULT_GOAL := help

# general
help:
	@echo "Type: make [rule]. Available options are:"
	@echo ""
	@echo "- help"
	@echo "- clear"
	@echo "- docker-compose-start"
	@echo "- docker-compose-stop"
	@echo "- docker-compose-start-console"
	@echo "- config-env-development"
	@echo "- config-env-production"
	@echo "- migrate-db"
	@echo "- nginx-reload"
	@echo "- composer-install"
	@echo "- composer-update"
	@echo ""

clear:
	rm -rf backend/runtime/*
	rm -rf frontend/runtime/*
	rm -rf common/runtime/*

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

config-env-development:
	docker exec y2aa_php_fpm make clear
	docker exec y2aa_php_fpm php init --env=Development --overwrite=All
	docker exec y2aa_php_fpm mkdir -p uploads/general

config-env-production:
	docker exec y2aa_php_fpm make clear
	docker exec y2aa_php_fpm php init --env=Production --overwrite=All
	docker exec y2aa_php_fpm mkdir -p uploads/general

migrate-db:
	docker exec y2aa_php_fpm php yii migrate --migrationPath=@common/migrations --interactive=0
	docker exec y2aa_php_fpm php yii migrate --migrationPath=@backend/migrations --interactive=0
	docker exec y2aa_php_fpm php yii migrate --migrationPath=@frontend/migrations --interactive=0

nginx-reload:
	docker exec y2aa_nginx service nginx reload

composer-install:
	docker exec y2aa_php_fpm composer install

composer-update:
	docker exec y2aa_php_fpm composer update