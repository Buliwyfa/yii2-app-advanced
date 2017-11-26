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
	@echo "- config-env-development"
	@echo "- config-env-production"
	@echo "- migrate-db"
	@echo "- nginx-reload"
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

docker-compose-stop:
	cd extras/docker && \
	    WWW_DIR=$(ROOT_DIR) docker-compose down

config-env-development:
	docker exec docker_php-fpm_1 make clear
	docker exec docker_php-fpm_1 php init --env=Development --overwrite=All

config-env-production:
	docker exec docker_php-fpm_1 make clear
	docker exec docker_php-fpm_1 php init --env=Production --overwrite=All

migrate-db:
	docker exec docker_php-fpm_1 php yii migrate --migrationPath=@common/migrations --interactive=0
	docker exec docker_php-fpm_1 php yii migrate --migrationPath=@backend/migrations --interactive=0
	docker exec docker_php-fpm_1 php yii migrate --migrationPath=@frontend/migrations --interactive=0

nginx-reload:
	docker exec docker_nginx_1 service nginx reload