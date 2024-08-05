default: up

USER_ID := $(shell id -u)

init:
	USER_ID=$(USER_ID) docker compose -p videostore up -d --build

up:
	docker compose -p videostore up -d

down:
	docker compose -p videostore down

dev:
	docker compose -p videostore exec app yarn encore dev

watch:
	docker compose -p videostore exec app yarn encore dev --watch

composer:
	docker compose -p videostore exec app composer install

test:
	docker compose -p videostore exec app php vendor/bin/phpunit

bash:
	@docker compose -p videostore exec -it app bash