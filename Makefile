
# Run php artisan serve
serve:
	php artisan serve

# Run php artisan migrate
migrate:
	php artisan migrate

# Run php artisan migrate:refresh
migrate-refresh:
	php artisan migrate:refresh

# Run php artisan db:seed
seed:
	php artisan db:seed

# Run php artisan make:migration with keyword
# Model name should be singular and table name should be plural
migration:
	php artisan make:migration $(keyword)

# Run php artisan make:controller with keyword

controller:
	php artisan make:controller $(keyword)

# Run php artisan make:model with keyword

model:
	php artisan make:model $(keyword)

# Run php artisan make:factory with keyword

factory:
	php artisan make:factory $(keyword)

# Run php route clear
route-clear:
	php artisan route:clear

# Run php route list
route-list:
	php artisan route:list

#Run npm run dev
npm-run:
	npm run dev

#Run npm build
npm-build:
	npm run build


