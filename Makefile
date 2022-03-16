up-build:
		docker-compose up -d
		docker exec -it bejao_backend bash
		make dev
dev:
		php artisan migrate:fresh --seed
cache:
		php artisan cache:clear
		php artisan route:cache
		php artisan view:cache
		php artisan config:cache

test:
		php artisan migrate:fresh
		php artisan test

