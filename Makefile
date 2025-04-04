.PHONY: install update serve fresh audit analyse test build

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
	php artisan serve --port=8001 & npm run dev

fresh:
	@echo "🗑️  Resetting database..."
	php artisan migrate:fresh --seed

audit:
	@echo "🔒 Audit..."
	composer audit
	npm audit
	vendor/bin/security-checker security:check

analyse:
	@echo "🧪 Analyse code..."
	vendor/bin/phpcs --standard=PSR12 app/
	php -d memory_limit=-1 vendor/bin/phpstan analyse
	vendor/bin/psalm

autofix:
	@echo "🤖 Auto fix code..."
	vendor/bin/php-cs-fixer fix app/
	vendor/bin/psalm --alter --issues=MissingReturnType,MissingOverrideAttribute,InvalidReturnType,ClassMustBeFinal

test:
	@echo "🧪 Running tests..."
	vendor/bin/phpunit tests/unit --testdox
	npx cypress run

build:
	@echo "📦 Building frontend..."
	npm run build
