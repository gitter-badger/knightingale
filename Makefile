default: help

help:
	@echo "Please use 'make <target>' where <target> is one of"
	@echo "  unit-tests             Executes the Unit tests"
	@echo "  integration-tests      Executes the Integration tests"
	@echo "  coverage               Creates the Coverage reports"
	@echo "  phpdoc                 Creates the API Documentation"

tests:
	./vendor/bin/phpunit

unit-tests:
	./vendor/bin/phpunit --exclude-group="integration-tests"

integration-tests:
	./vendor/bin/phpunit --group="integration-tests"

coverage:
	./vendor/bin/phpunit --coverage-html build/coverage

coverage-unit:
	./vendor/bin/phpunit --exclude-group="integration-tests" --coverage-html build/coverage

travis-unit-tests:
	./vendor/bin/phpunit --exclude-group="integration-tests" --coverage-clover build/coverage-unit-tests.clover

travis-integration-tests:
	./vendor/bin/phpunit --group="integration-tests" --coverage-clover build/coverage-integration-tests.clover

view-coverage: coverage
	open build/coverage/index.html

phpdoc:
	./vendor/bin/phpdoc

view-phpdoc: phpdoc
	open build/phpdoc/index.html

.PHONY: tests unit-tests integration-tests coverage coverage-unit view-coverage phpdoc view-phpdoc
