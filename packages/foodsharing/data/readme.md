# Foodsharing Data Repository

This Repo will hold the whole Datalogic of Foodsharing in as a Laravel Package.

  - Foodsaver
  - Stores
  - Teams...
  - ...

## Installation

1. Go into your Foodsharing laravel Project and add tht requires composer package

```shell
$ composer require foodsharing/data "dev-master"
```

2. register Laravel Service Provider in "config/app.php".

```php
    'providers' => [
    // ...
    Foodsharing\Data\DataServiceProvider::class,
    // ...
```

3. Ready! For mor read the [Laravel Dokumentation](https://laravel.com/docs).

## Use Repository

To use an Repository fetch it in your Laravel Controller you have to add an constructor i.e.

```php
...

class StoreController extends Controller
{
    private $repo_store;

    public function __construct(StoreRepo $store_repo) {
        $this->repo_store = $store_repo;
    }

    public function profile() {

        $store = $this->repo_store->find(123);
        
        return view('store',[
		'store' => $store
	]);

    }
}
```
