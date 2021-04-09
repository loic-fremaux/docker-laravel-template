# Setup process

- Edit project settings in composer.json
- Move .env.example or .env.prod.example to .env and edit parameters to match your project
- Start containers with `docker-compose up -d`
- Go into the php container with `docker-compose exec php bash`
- Run `composer install`
- Run `npm install`
- Enjoy :)
