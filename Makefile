DOCKER_COMP = docker compose

PHP_CONT_FRONT = $(DOCKER_COMP) exec php-front
PHP_CONT_BACK = $(DOCKER_COMP) exec php-back

PHP      = $(PHP_CONT_BACK) php
COMPOSER_BACK = $(PHP_CONT_BACK) composer
COMPOSER_FRONT = $(PHP_CONT_BACK) composer
MICRO_BACK_BASH  = $(PHP_CONT_BACK) bin/console
MICRO_FRONT_BASH  = $(PHP_CONT_FRONT) bin/console

.DEFAULT_GOAL = help
.PHONY        : help build up start down logs sh composer vendor sf cc

help:
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

build: ## Pull and make docker images and compile application components
	@$(DOCKER_COMP) build --pull --no-cache

db-create:
	@$(PHP_CONT_FRONT) php bin/console orm:schema-tool:create

db-update:
	@$(PHP_CONT_FRONT) php bin/console orm:schema-tool:update --force

test: ## Run all tests from `phpunit.xml`
	@$(PHP_CONT_BACK) php vendor/bin/phpunit --verbose

up: ## Run made application
	@$(DOCKER_COMP) up --detach

start: up ## Alias for `make up`

down: ## Shutdown all containers
	@$(DOCKER_COMP) down --remove-orphans

logs: ## Listen to logs in php container
	@$(DOCKER_COMP) logs --tail=0 --follow

shd: ## Open bash terminal in the "php-back" node.

	@$(PHP_CONT_BACK) sh
shf: ## Open bash terminal in the "php-front" node.
	@$(PHP_CONT_FRONT) sh

composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req micro/plugin-doctrine'
	@$(eval c ?=)
	@$(COMPOSER_BACK) $(c)

vendor: ## composer install dependencies
vendor: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor: composer

micro-back: ## List all Micro commands or pass the parameter "c=" to run a given command, example: make sf c=about in the "php-back" node
	@$(eval c ?=)
	@$(COMPOSER_BACK) $(c)

micro-front: ## List all Micro commands or pass the parameter "c=" to run a given command, example: make sf c=about in the "php-back" node
	@$(eval c ?=)
	@$(COMPOSER_FRONT) $(c)
