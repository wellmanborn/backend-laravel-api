composer require laravel/breeze

php artisan breeze:install api

php artisan migrate

composer require spatie/data-transfer-object

php artisan queue:table

composer require beyondcode/laravel-websockets -W

php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"

php artisan migrate

php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"



