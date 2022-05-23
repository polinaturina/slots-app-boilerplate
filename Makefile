ifeq ($(shell uname -s), Darwin)
composer-install: composer-install-macos
composer-update: composer-update-macos
else
composer-install: composer-install-linux
composer-update: composer-update-linux
endif

.PHONY: composer-install-linux
composer-install-linux:
	docker run --rm --interactive --tty --volume /etc/passwd:/etc/passwd:ro --volume /etc/group:/etc/group:ro --volume ${SSH_AUTH_SOCK}:/tmp/ssh-agent --volume ${PWD}:/app -e SSH_AUTH_SOCK=/tmp/ssh-agent composer:2 install --ignore-platform-reqs

.PHONY: composer-install-macos
composer-install-macos:
	docker run --rm --interactive --tty --volume /run/host-services/ssh-auth.sock:/tmp/ssh-agent --volume ${PWD}:/app -e SSH_AUTH_SOCK=/tmp/ssh-agent composer:2 install --ignore-platform-reqs

.PHONY: composer-update-linux
composer-update-linux:
	docker run --rm --interactive --tty --volume /etc/passwd:/etc/passwd:ro --volume /etc/group:/etc/group:ro --volume ${SSH_AUTH_SOCK}:/tmp/ssh-agent --volume ${PWD}:/app:Z -e SSH_AUTH_SOCK=/tmp/ssh-agent composer:2 update --ignore-platform-reqs

.PHONY: composer-update-macos
composer-update-macos:
	docker run --rm --interactive --tty --volume /run/host-services/ssh-auth.sock:/tmp/ssh-agent --volume ${PWD}:/app -e SSH_AUTH_SOCK=/tmp/ssh-agent composer:2 update --ignore-platform-reqs

run-migrations:
	docker-compose run --rm app php bin/console doctrine:migrations:migrate

csfixer:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src

persist-doctor-table:
	docker-compose run --rm app php bin/console app:create-doctor

generate-new-migration:
	docker-compose run --rm php bin/console doctrine:migrations:generate

persist-slot-table:
	docker-compose run --rm app php bin/console app:pull-doctor-slots
