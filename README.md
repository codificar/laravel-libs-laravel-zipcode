# laravel-zipcode

Uma biblioteca para consulta de ZipCode através dos Providers Canducci E CEPAberto, com a possibilidade de inserir mais ao longo do tempo.


## Getting Started

Add in composer.json:

```php
"repositories": [
    {
        "type": "vcs",
        "url": "https://libs:ofImhksJ@git.codificar.com.br/laravel-libs/laravel-zipcode.git"
    }
]
```

```php
require:{
        "codificar/zipcode": "0.1.2",
}
```

```php
"autoload": {
    "psr-4": {
        "Codificar\\ZipCode\\": "vendor/codificar/zipcode/src/"
    }
}
```
Update project dependencies:

```shell
$ composer update
```

Register the service provider in `config/app.php`:

```php
'providers' => [
  /*
   * Package Service Providers...
   */
  Codificar\ZipCode\ZipCodeServiceProvider::class,
],
```


Check if has the laravel publishes in composer.json with public_vuejs_libs tag:

```
    "scripts": {
        //...
		"post-autoload-dump": [
			"@php artisan vendor:publish --tag=public_vuejs_libs --force"
		]
	},
```

Or publish by yourself


Publish Js Libs and Tests:

```shell
$ php artisan vendor:publish --tag=public_vuejs_libs --force
```

- Migrate the database tables

```shell
php artisan migrate
```
