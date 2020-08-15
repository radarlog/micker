.SILENT:
.DEFAULT_GOAL := help

.PHONY: help
help: ; $(info Usage:)
	echo "make run              build environment"
	echo "make tests            run tests"

.PHONY: up
up: ; $(info Starting containers:)
	docker-compose up -d

.PHONY: down
down: ; $(info Shutting down containers:)
	docker-compose down

.PHONY: composer
composer: ; $(info Installing dependencies:)
	docker-compose run -T --rm php composer validate --ansi --no-interaction --strict
	docker-compose run -T --rm php composer install --ansi --no-interaction

.PHONY: run
run: composer up ; $(info Environment has been built succesfully)
	echo -e "Now open http://localhost:8080/index.html in the browser"

.PHONY: styles-check
styles-check: ; $(info $(M) Checking coding style:)
	docker-compose run -T --rm php vendor/bin/phpcs -ps

.PHONY: static-analysis
static-analysis: ; $(info $(M) Performing static analyze:)
	docker-compose run -T --rm php vendor/bin/phpstan analyse --ansi
	docker-compose run -T --rm php vendor/bin/psalm --taint-analysis

.PHONY: tests
tests: composer styles-check static-analysis ; $(info Running tests:)
	docker-compose run -T --rm php vendor/bin/phpunit
