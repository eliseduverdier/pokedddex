# Executables (local)
DOCKER_COMP = docker-compose

# Docker containers
PHP_CONT = $(DOCKER_COMP) exec php

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY  = $(PHP_CONT) bin/console

# Misc
.DEFAULT_GOAL = help
.PHONY        = help build up start down logs sh composer vendor sf cc db-reset deptrac php-cs-fixer

## —— 🎵 🐳 The Symfony-docker Makefile 🐳 🎵 ——————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Docker 🐳 ————————————————————————————————————————————————————————————————
build: ## Builds the Docker images
	@$(DOCKER_COMP) build --pull --no-cache

up: ## Start the docker hub in detached mode (no logs)
	@$(DOCKER_COMP) up --detach

start: build up ## Build and start the containers

down: ## Stop the docker hub
	@$(DOCKER_COMP) down --remove-orphans

logs: ## Show live logs
	@$(DOCKER_COMP) logs --tail=0 --follow

sh: ## Connect to the PHP FPM container
	@$(PHP_CONT) sh

## —— Composer 🧙 ——————————————————————————————————————————————————————————————
composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(COMPOSER) $(c)

vendor: ## Install vendors according to the current composer.lock file
vendor: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor: composer

## —— Symfony 🎵 ———————————————————————————————————————————————————————————————
sf: ## List all Symfony commands or pass the parameter "c=" to run a given command, example: make sf c=about
	@$(eval c ?=)
	@$(SYMFONY) $(c)

cc: c=c:c ## Clear the cache
cc: sf

## —— Doctrine 🎵 ———————————————————————————————————————————————————————————————
db-reset: ## Reset database
	@$(SYMFONY) doctrine:database:drop --force --if-exists -nq
	@$(SYMFONY) doctrine:database:create -nq
	@$(SYMFONY) doctrine:migrations:migrate -nq
	@$(SYMFONY) doctrine:fixtures:load -nq

db-pokemons: ## Reset database
	@$(SYMFONY) doctrine:database:drop --force --if-exists -nq
	@$(SYMFONY) doctrine:database:create -nq
	@$(SYMFONY) doctrine:sc:up --force -nq
	@$(SYMFONY) pokedex:load:pokemons
	@$(SYMFONY) pokedex:load:users

jwt: ## init JWT
	@$(SYMFONY) lexik:jwt:generate-keypair

## —— Deptrac 🎵 ———————————————————————————————————————————————————————————————
deptrac: ## Run layers depedencies analysis
	@echo "\n\e[7mChecking DDD layers...\e[0m"
	@$(PHP_CONT) vendor/bin/deptrac analyze --fail-on-uncovered --report-uncovered --no-progress depfile_ddd.yaml

## —— PHP-CS-Fixer 🎵 ———————————————————————————————————————————————————————————————
php-cs-fixer: ## Fix PHP code style
	@$(PHP_CONT) vendor/bin/php-cs-fixer fix

## —— PHPUnit 🎵 ———————————————————————————————————————————————————————————————
phpunit: ## Run tests
	@$(PHP_CONT) bin/phpunit

## —— Psalm 🎵 ———————————————————————————————————————————————————————————————
psalm: ## Run psalm
	@$(PHP_CONT) vendor/bin/psalm
