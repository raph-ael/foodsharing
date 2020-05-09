# THIS HERE IS OUTDATED WE MOVED TO GITLAB - FCK MICROSOFT
=> https://gitlab.com/foodsharing-dev

# foodsharing.de
The opensourced foodsharing and saving application foodsharing.de


## About foodsharing

foodsharing.de is an online platform that saves and distributes surplus food in Germany and Austria. It is managed by the Foodsharing association (foodsharing e.V.) and was founded on December 12, 2012. On foodsharing.de individuals, retailers and producers can offer or collect food that would otherwise be thrown away. This service is completely free, and functions thanks to volunteer work. The projects' goal is to fight everyday food waste and to raise awareness about this problem in society. (Source: https://en.wikipedia.org/wiki/Foodsharing.de)

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
