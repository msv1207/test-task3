#!make
include .env
export $(shell sed 's/=.*//' .env)


init_cert:
	./init-letsencrypt.sh
	@echo "Cert ready!"


init:
	docker-compose pull
	docker-compose up -d --build

	docker-compose exec -T php-fpm chmod -R 777 storage/
	docker-compose exec -T php-fpm chmod -R 777 bootstrap/

	docker-compose exec -T php-fpm php -r "file_exists('.env') || copy('.env.example', '.env');"

	docker-compose exec -T php-fpm composer install --ignore-platform-reqs
	docker-compose exec -T php-fpm composer dump-autoload

	docker-compose exec -T php-fpm php artisan package:discover --ansi
	docker-compose exec -T php-fpm php artisan key:generate --ansi
	docker-compose exec -T php-fpm php artisan jwt:secret

	docker-compose exec php-fpm php artisan config:cache \
		&& docker-compose exec php-fpm php artisan event:cache \
		&& docker-compose exec php-fpm php artisan route:cache \
		&& docker-compose exec php-fpm php artisan view:cache

	docker-compose exec -T php-fpm php artisan migrate
    docker-compose exec -T php-fpm php artisan db:seed

    docker-compose exec -T php-fpm php artisan storage:link

	@echo "System ready!"


update:
	docker-compose pull
	docker-compose up -d

	docker-compose exec php-fpm composer install --ignore-platform-reqs \
		&& docker-compose exec php-fpm composer dump-autoload

	docker-compose exec php-fpm php artisan config:cache \
		&& docker-compose exec php-fpm php artisan event:cache \
		&& docker-compose exec php-fpm php artisan route:cache \
		&& docker-compose exec php-fpm php artisan view:cache

	docker-compose exec php-fpm php artisan migrate

	docker-compose restart

	@echo "System updated!"


build:
	docker-compose pull
	docker-compose up -d --build

	docker-compose exec -T php-fpm chmod -R 777 storage/
	docker-compose exec -T php-fpm chmod -R 777 bootstrap/

	docker-compose exec -T php-fpm php -r "file_exists('.env') || copy('.env.example', '.env');"

	docker-compose exec -T php-fpm composer install --ignore-platform-reqs --no-dev
	docker-compose exec -T php-fpm composer dump-autoload

	docker-compose exec -T php-fpm php artisan package:discover --ansi
	docker-compose exec -T php-fpm php artisan key:generate --ansi
	docker-compose exec -T php-fpm php artisan jwt:secret

	docker-compose exec php-fpm php artisan config:cache \
		&& docker-compose exec php-fpm php artisan event:cache \
		&& docker-compose exec php-fpm php artisan route:cache \
		&& docker-compose exec php-fpm php artisan view:cache

	docker-compose exec -T php-fpm php artisan migrate
	docker-compose exec -T php-fpm php artisan db:seed

    docker-compose exec -T php-fpm php artisan storage:link

	@echo "Build ready!"


update_web:
	docker-compose pull
	docker-compose up -d

	@echo "System updated"


test:
	@echo "Run unit tests:"
	docker-compose exec -T php-fpm php artisan test --parallel --testsuite=Unit

	@echo "Run feature tests:"
	docker-compose exec -T php-fpm php artisan test --parallel --testsuite=Feature

	@echo "Testing ended"


phpreport:
	docker-compose exec php-fpm php ./vendor/bin/phpmetrics --report-html=phpreport ./app

	@echo "Report generated"
