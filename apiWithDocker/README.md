<h1> Test Fidesio (sf6, php8) </h1>

## —— Install dependencies & start docker and go to home page http://127.0.0.1:8000/:--
```
make init
```

## —— Divers Commands ——
make start: ## Start app 
make stop: ## Stop app
composer-install: ## Install dependencies
composer-update: ## Update dependencies
database-init: ## Init database
database-create: ## Create database
database-remove: ## Drop database
database-migration: ## Make migration
migration: ## Alias : database-migration
database-migrate: ## Migrate migrations
migrate: ## Alias : database-migrate
database-load-fixtures: ## Load Fixtures
load-fixtures: ## Alias : database-load-fixtures


## ——To see all commands --
```
make help
```




