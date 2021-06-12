# README

## SYSTEM REQUIREMENT

* DB
  - MySQL 5.6
* Apache 
    - 2.4
* PHP
  - 7.0
* Laravel
  - 5.8
* Composer
  - 1.4.1


## Deploy
* permission
```
chmod -R 777 bootstrap/cache
chmod -R 777 storage/logs/
chmod -R 777 storage
chmod -R 777 storage/framework
chmod -R 777 public/media
chmod -R 777 public/tmp_uploads
```

* run
```bash
 composer install
 php artisan config:cache
 php artisan config:clear
 php artisan cache:clear
```

* run deploy
```bash
cp .env.example .env
php artisan key:generate
```
* config your database in .env
find and replace database config
```bash
vi .env
```
* run database
```bash
php artisan migrate
php artisan db:seed
```

* account
```bash
admin: 
    /ad-admin/login: support+admin@system-rps.com/aA@dmin123
frontend:
    /login: support+rps1@system-rps.com/123456
```

* cronjob run at 1am every day
```bash
php artisan api:reward-invest
```