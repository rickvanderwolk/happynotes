.PHONY: install update serve fresh test build

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

test:
	@echo "🧪 Running tests..."
	vendor/bin/phpunit tests/unit --testdox
	npx cypress run

build:
	@echo "📦 Building frontend..."
	npm run build
