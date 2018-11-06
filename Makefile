#!/usr/bin/make -f
SHELL = /bin/sh

.PHONY : style analyze
.DEFAULT_GOAL := list

all: style analyze

list:
	@echo "Available targets: "
	@$(MAKE) -pRrq -f $(lastword $(MAKEFILE_LIST)) : 2>/dev/null | awk -v RS= -F: '/^# File/,/^# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | egrep -v -e '^[^[:alnum:]]' -e '^$@$$' | xargs

style:
	php vendor/bin/php-cs-fixer fix .

analyze:
	php vendor/bin/phpstan analyze .