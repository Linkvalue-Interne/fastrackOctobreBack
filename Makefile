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
	vendor/bin/phpcs src

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

## Generate the SSH keys JWT
#############################

gen-key:
	docker exec -it fastrackOctobreBack_php sh -c 'mkdir -p config/jwt'
	docker exec -it fastrackOctobreBack_php sh -c 'openssl genpkey -pass pass:${JWT_PASSPHRASE} -out ${JWT_SECRET_KEY} -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096'
 	docker exec -it fastrackOctobreBack_php sh -c 'openssl pkey -passin pass:${JWT_PASSPHRASE} -in ${JWT_SECRET_KEY} -out ${JWT_PUBLIC_KEY} -pubout'
