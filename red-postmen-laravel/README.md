# Red Postmen

App to manage volunteer that help to distribue info / letter / commercial paper in the neighborhoods

## TODO

- Make the app real, what needed for a v1
    - Make the todo of what we really want ...
- Make the todo of the dream we have for this app !

## Tech

### Laravel with React starter kit

https://laravel.com/starter-kits

### PostgreSQL

## Launch for dev

Install PHP and composer

"podman compose -f docker-compose.yaml -p redpostmen_pg up" or equivalent will create the docker DB

"php artisan migrate:fresh --seed" to refresh the DB with mock data

"composer run dev" will run the project in localhost

## Some command

php artisan db:show - see the db stade

php artisan db:table <x> - see the info details of a table

php artisan make:migration create\_<x>\_table - create a migration file (php artisan make:migration <x> - work too)

php artisan migrate - execute the migration file

php artisan db:seed - seed the database with mock data (php artisan migrate:fresh --seed - the same but with refresh all)

composer run dev - run the project in localhost

<!-- php artisan app:create-admin - cmd to create a new admin, usefull in prod -->

podman compose -f docker-compose.yaml -p redpostmen_pg up - launch with podman the docker and name it redpostmen_pg

## Production

- Most of the information are there, https://laravel.com/docs/12.x/deployment

- composer install --no-dev --optimize-autoloader - install the base package

- php artisan key:generate - usefull to create the APP_KEY env var - needed for the first deploy

- php artisan migrate - to make the migration of the db schema in case of new thing

- php artisan optimize

- npm i && npm run build - to launch the frontend part

- php artisan app:create-admin - to create a new admin, the only way to add it
