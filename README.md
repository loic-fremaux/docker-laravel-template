# Laravel docker template
## Setup process

- Verify settings in composer.json like the project name and description
- Move .env.example or .env.prod.example to .env and edit parameters to match your project
- Make sure permission are well-defined for 1000:1000 (`sudo chown 1000:1000 /path/ -R`)
- Start containers with `docker-compose up -d`
- Go into the php container with `docker-compose exec php bash`
- Install libs with `composer install`
- Setup nodejs with `npm install`
- Generate application secret key with `php artisan key:generate`
- Enjoy :)

## Utilisation vitejs in laravel

- Start container dev `docker-compose up`
- check the variable `VITE_DEV` to 1 for the dev in .env
- For images creates a symbolic link in the public folder `ln -s ../assets/ assets`
- Dependency install `vitejs`, `react vanilla` and `sass`
- Enjoy :)

