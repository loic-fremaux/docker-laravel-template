# Laravel docker template
## Setup a new project

- Update composer.json, you can change the project name / description and tags for example
- Move .env.example or .env.prod.example to .env and edit it according to your project
- Start containers with `docker-compose up -d`
- Run into the php container with `docker-compose exec php bash`
- Install php libs with `composer install`
- Install javascript libs with `npm install`
- Run either `npm run dev` or `npm run prod`
- Generate application secret key with `php artisan key:generate`
- Enjoy :)

## Other commands

1. Install bootstrap
- `composer require laravel/ui`
- `php artisan ui bootstrap`
- `npm install && npm run dev`
