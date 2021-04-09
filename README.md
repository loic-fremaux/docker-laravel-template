# Setup process

- Edit project settings in composer.json
- Move .env.example or .env.prod.example to .env and edit parameters to match your project
- Check settings in docker-compose.yml
- Go into the php container by executing `docker-compose exec php bash`
- Run `composer install`
- Run `npm install`
- Enjoy :)
