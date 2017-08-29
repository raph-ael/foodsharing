# foodsharing.de
The opensourced foodsharing and saving application foodsharing.de


## About foodsharing

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Installation

1. Clone the repo and go in the repo directory

```
git clone -b laravel_admin --single-branch git@gitlab.com:foodsharing-dev/foodsharing.git
cd foodsharing
```


2. get composer dependencies

```
composer install
```


3. run dev server

```
php artisan serv
```

4. Go to http://localhost:8000/install

instead of using web installer you can also use the command `php artisan fs:install`

### additional

Seed some dummy users

```
php artisan fs:seed
```

minify changes in css and js files

```
php artisan fs:minify
```

## foodsharing Sponsors

<img src="http://pt-ad.pt-dlr.de/_img/article/Logo_BMBF-gef-mit.jpg" width="250" />

Finalist 1st round of [prototypefund](https://prototypefund.de/)

<img src="https://prototypefund.de/wp-content/uploads/2016/08/PrototypeFund-P-Logo.png" height="250" />


## License

The foodsharing framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).