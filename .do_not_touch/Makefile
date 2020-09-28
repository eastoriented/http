#
# This file is part of eastoriented/library.
#
# For the sake of mankind, DO NOT MODIFY IT!
#
# Have a good day!
#
include .do_not_touch/config.mk

THIS_DIR := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
RESOURCES_DIR := $(THIS_DIR)/resources
MKDIR=mkdir -p
RM=rm -rf
DOCKER_COMPOSE:=$(shell which docker-compose || echo 'bin/docker-compose')
DOCKER_COMPOSE_VERSION=1.23.2
CURRENT_VERSION:=$(shell git describe --tags --abbrev=0 2>/dev/null || echo 0.0.0)

ifneq ($(WITH_DEBUG),)
OLD_SHELL := $(SHELL)
SHELL = $(warning $(if $@, Update target $@)$(if $<, from $<)$(if $?, due to $?))$(OLD_SHELL) -x
endif

define locate
$(or $(shell which $1),$(error \`$1\` is not in \`$(PATH)\`, please install it!))
endef

define binary
$(call write,$1,'#!/usr/bin/env sh')
$(call write,$1,'set -e')
$(call write,$1,'exec $(DOCKER_COMPOSE) run --rm $2 $3 "$$@"')
chmod u+x $1
endef

define semver
git tag $$($(DOCKER_COMPOSE) run --rm semver semver -c -i $1 $$(git describe --tags --abbrev=0 2>/dev/null || echo 0.0.0))
endef

define write
echo $2 >> $1
endef

.SILENT:

.SUFFIXES:

.DELETE_ON_ERROR:

.PRECIOUS: %/.

## The help, because if no help, no RTFM

.PHONY: help
help: ## Display this help.
	@printf "$$(cat $(MAKEFILE_LIST) | egrep -h '^[^:]+:[^#]+## .+$$' | sed -e 's/:[^#]*##/:/' -e 's/\(.*\):/\\033[92m\1\\033[0m:/' | sort -d | column -c2 -t -s :)\n"

%/.:
	$(MKDIR) $@

install: $(call locate,docker) bin/php bin/composer ## Install development environment

.env:
	$(call write,$@,"HOME=$(HOME)")
	$(call write,$@,"USER_ID=$$(id -u):$$(id -g)")

bin/php: | docker-compose.yml bin/. $(DOCKER_COMPOSE) ## Create wrapper for `php` using `docker`
	$(call binary,$@,php-cli,php)

bin/atoum: | docker-compose.yml bin/. .atoum.php vendor $(DOCKER_COMPOSE) ## Create wrapper for `atoum` using `docker`
	$(call binary,$@,php-cli,/src/vendor/$@)

bin/composer: | docker-compose.yml bin/. .env $(DOCKER_COMPOSE) ## Create wrapper for `composer` using `docker`
	$(call binary,$@,composer,composer)

bin/docker-compose: | $(call locate,curl) bin/. .env docker-compose.yml ## Create wrapper for `docker-compose` using `docker`
	curl -L --fail https://github.com/docker/compose/releases/download/$(DOCKER_COMPOSE_VERSION)/run.sh -o $@
	chmod u+x $@

vendor: vendor/autoload.php ## Update `vendor` directory

vendor/autoload.php: composer.lock | bin/composer ## Create `vendor` directory
	bin/composer install --no-suggest

vendor/update: | bin/composer
	bin/composer update --no-suggest
	./vendor/bin/eastoriented-library install

.PHONY: autoload
autoload: composer.json | bin/composer ## Generate autoload files
	bin/composer dump-autoload

.PHONY: tests/units
tests/units: | bin/php tests/units/runner.php vendor ## Run unit tests
	bin/php tests/units/runner.php

.PHONY: version/new/major
version/new/major: | $(DOCKER_COMPOSE) ## Create tag for new major version
	$(call semver,major)

.PHONY: version/new/minor
version/new/minor: | $(DOCKER_COMPOSE) ## Create tag for new minor version
	$(call semver,minor)

.PHONY: version/new/patch
version/new/patch: | $(DOCKER_COMPOSE) ## Create tag for new patch version
	$(call semver,patch)

.PHONY: verbose
ifeq "$(firstword $(MAKECMDGOALS))" "verbose"
verbose: ## Display all executed commands during targets building
	$(MAKE) $(filter-out verbose,$(MAKECMDGOALS)) WITH_DEBUG=TRUE
else
verbose:
	$(error Verbose syntax is `make verbose <target>`, not `make <target> verbose`)
endif