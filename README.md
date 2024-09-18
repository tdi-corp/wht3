# Laravel 11 & Vue 3 SPA Starter Kit
[![](https://img.shields.io/badge/Vue-v3.4-04C690?style=flat)](https://vuejs.org/)
[![](https://img.shields.io/badge/Laravel-v11-ff2e21?style=flat)](https://laravel.com)

## Technology
- PHP-FPM 8.3
- Laravel 11
- Node 20.16
- Vue, Vuex
- Docker & Docker Compose
- Nginx
- Mysql

## How it works
### Containers
1) **api**: serves the backend app (laravel app)
2) **client**: serves the fronted app (vue app)
3) **webserver**: services static content, storage, and passes traffic to api & client containers (proxy)
4) **mysql**: main database connection

## Installation
it includes compiling and hot-reloading for development

### 1. Copy .env.dev
```
cp api/.env.dev.example api/.env.dev
```

### 2. Laravel Permission folder in api folder
API_PATH - example: /var/www/my_project/api
```
sudo chown -R $USER:$USER API_PATH

sudo find API_PATH -type f -exec chmod 644 {} \;  
sudo find API_PATH -type d -exec chmod 755 {} \;

sudo chmod -R 777 API_PATH/storage API_PATH/bootstrap/cache
```
### 3. Docker build & up project
```
docker-compose -f docker-compose.yml -f docker-compose.dev.yml up --build
```
### 4. run the migrations
```
docker exec -it spa-dev-api-1 php artisan migrate --seed
```
- To access the api open http://localhost:8000
- To access the client open http://localhost:3000

