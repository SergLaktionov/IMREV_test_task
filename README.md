## Steps to run
From root project directory
```
1. make copy of `.env.example` file, rename to `.env`
2. docker compose up -d
3. docker compose run --rm app composer install
4. docker compose run --rm app php artisan key:generate
5. docker compose run --rm app php artisan migrate
6. docker compose run --rm app php artisan db:seed
7. docker compose run --rm npm install
8. docker compose run --rm npm run build
```
Open http://localhost:8000

User for test:
```
email - admin@example.com
password - password
```