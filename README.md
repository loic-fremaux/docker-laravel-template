# Setup process

- Edit project settings in composer.json
- Move .env.example or .env.prod.example to .env and edit parameters to match your project
- Start containers with `docker-compose up -d`
- Go into the php container with `docker-compose exec php bash`
- Install libs with `composer install`
- Setup nodejs with `npm install`
- Run either `npm run dev` or `npm run prod`
- Generate application secret key with `php artisan key:generate`
- Enjoy :)
