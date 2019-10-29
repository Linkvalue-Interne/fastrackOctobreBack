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
