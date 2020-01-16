<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Installation Composer

Download and install Composer by following the <a href="https://getcomposer.org/download/">official instructions.</a> 

For usage, see <a href="https://getcomposer.org/download/"> the documentation.</a>

## Update composer.json 
Run the following command to install vendor folder: 
```
composer update
```

## Laravel Environment
env. File configuration must database connection

## Laravel Queue configuration env. file
```
QUEUE_DRIVER=database
```

## The generated migration is imported.

```
php artisan migrate
```