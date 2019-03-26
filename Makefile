#!/usr/bin/make -f
SHELL = /bin/sh

.PHONY : style analyze build lint
.DEFAULT_GOAL := list

all: lint analyze

list:
	@echo "Available targets: "
	@$(MAKE) -pRrq -f $(lastword $(MAKEFILE_LIST)) : 2>/dev/null | awk -v RS= -F: '/^# File/,/^# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | egrep -v -e '^[^[:alnum:]]' -e '^$@$$' | xargs

style:
	php vendor/bin/php-cs-fixer fix .

analyze:
	php vendor/bin/phpstan analyze .

build:
	docker build -t php-sic .

lint:
	php vendor/bin/php-cs-fixer fix --dry-run --verbose .