install:
	concurrently "cd back && composer install" "cd front && pnpm install"

start:
	concurrently "cd back && php -S localhost:1234 -t src/web" "cd front && pnpm run dev"
