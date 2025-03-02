.PHONY: install update serve fresh analyse test build

install:
	@echo "🔧 Installing dependencies..."
	composer install
	npm install

update:
	@echo "🔧 Updating dependencies..."
	composer update
	npm update

serve:
	@echo "🚀 Starting Laravel and Vite..."
	php artisan serve & npm run dev

fresh:
	@echo "🗑️  Resetting database..."
	php artisan migrate:fresh --seed

analyse:
	@echo "🧪 Analyse code..."
	vendor/bin/phpcs --standard=PSR12 app/
	php -d memory_limit=-1 vendor/bin/phpstan analyse

autofix:
	@echo "🤖 Auto fix code..."
	vendor/bin/php-cs-fixer fix app/

test:
	@echo "🧪 Running tests..."
	vendor/bin/phpunit tests/unit --testdox
	npx cypress run

build:
	@echo "📦 Building frontend..."
	npm run build
