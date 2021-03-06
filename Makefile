TESTSUITE=Small,Medium,Large

shell-php:
	docker exec -it fastrackOctobreBack_php ash

shell-sql:
	docker exec -it fastrackOctobreBack_sql bash

shell-web:
	docker exec -it fastrackOctobreBack_web ash

start:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down --rmi all -v --remove-orphans

lint:
	php-cs-fixer fix src/
	php-cs-fixer fix tests/

test:
	docker exec -it fastrackOctobreBack_php sh -c "APP_ENV=test php bin/console doctrine:database:drop --force --if-exists"
	docker exec -it fastrackOctobreBack_php sh -c "APP_ENV=test php bin/console doctrine:database:create --if-not-exists"
	docker exec -it fastrackOctobreBack_php sh -c "APP_ENV=test php bin/console doctrine:schema:update --force"
	docker exec -it fastrackOctobreBack_php sh -c "APP_ENV=test php bin/console hautelook:fixtures:load --no-interaction"
	docker exec -it fastrackOctobreBack_php sh -c "APP_ENV=test php vendor/bin/phpunit --testsuite=${TESTSUITE}"

test-small: TESTSUITE=Small
test-small: test

test-medium: TESTSUITE=Medium
test-medium: test

test-large: TESTSUITE=Large
test-large: test

## Composer commands
######################

install-vendor:
	docker exec -it fastrackOctobreBack_php composer install

update-vendor:
	docker exec -it fastrackOctobreBack_php composer update

## Generate JWT key ssh
########################

gen-jwt: sh gen-key.sh