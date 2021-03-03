<p align="center"><img src="https://codeigniter.com/assets/images/codeigniter4logo.png" width="200"></p>

<p align="center">
<a href="https://packagist.org/packages/agungsugiarto/boilerplate"><img src="https://poser.pugx.org/agungsugiarto/boilerplate/version"></a>
<a href="https://packagist.org/packages/agungsugiarto/boilerplate"><img src="https://img.shields.io/badge/Package-agungsugiarto%2Fboilerplate-light.svg"></a>
<a href="https://packagist.org/packages/agungsugiarto/boilerplate"><img src="https://poser.pugx.org/agungsugiarto/boilerplate/downloads"</img></a>
<a href="https://github.com/agungsugiarto/boilerplate/blob/master/LICENSE.md"><img src="https://img.shields.io/github/license/agungsugiarto/boilerplate"></a>
</p>

CodeIgniter 4 Application Boilerplate
=====================================
This package for CodeIgniter 4 serves as a basic platform for quickly creating a back-office application. It includes profile creation and management, user management, roles, permissions and a dynamically generated menu.

Feature
-------
* Configurable backend theme [AdminLTE 3](https://adminlte.io/docs/3.0/)
* Css framework [Bootstrap 4](https://getbootstrap.com/)
* Icons by [Font Awesome 5](https://fontawesome.com/)
* Role-based permissions provided by [Myth/Auth](https://github.com/lonnieezell/myth-auth)
* Menu dynamically
* Localized English / Indonesian

This project is early on development feel free to contribute
------------------------------------------------------------
Screenshoot | Demo On [Heroku](https://boilerplate-codeigniter4.herokuapp.com/)
-------------------------------------------------------------------------------
![Dashboard](.github/dashboard.png?raw=true)

Installation
------------

**1.** Get The Module, since packages myth/auth still on development we need to change composer.json in root project directory. Open composer.json with your text editor and add code like [this](https://github.com/agungsugiarto/boilerplate/blob/master/composer.json#L27-L28), or below like this.

```bash
"minimum-stability": "dev",
"prefer-stable": true,
```

And run require via composer

```bash
composer require agungsugiarto/boilerplate
```

**2.** Set CI_ENVIRONMENT, base url, index page, and database config in your `.env` file based on your existing database (If you don't have a `.env` file, you can copy first from `env` file: `cp env .env` first). If the database not exists, create database first.

```bash
# .env file
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080'
app.indexPage = ''

database.default.hostname = localhost
database.default.database = boilerplate
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```
**3.** Run publish auth
```bash
php spark auth:publish

Publish Migration? [y, n]: y
  created: Database/Migrations/2017-11-20-223112_create_auth_tables.php
  Remember to run `spark migrate -all` to migrate the database.
Publish Models? [y, n]: n
Publish Entities? [y, n]: n
Publish Controller? [y, n]: n
Publish Views? [y, n]: n
Publish Filters? [y, n]: n
Publish Config file? [y, n]: y
  created: Config/Auth.php
Publish Language file? [y, n]: n
```

> NOTE: Everything about how to configure auth you can find add [Myth/Auth](https://github.com/lonnieezell/myth-auth).


Its done ? not to fast. After the publish `Config/Auth.php` you need to change
`public $views` with below like this.
```php
public $views = [
    'login'           => 'agungsugiarto\boilerplate\Views\Authentication\login',
    'register'        => 'agungsugiarto\boilerplate\Views\Authentication\register',
    'forgot'          => 'agungsugiarto\boilerplate\Views\Authentication\forgot',
    'reset'           => 'agungsugiarto\boilerplate\Views\Authentication\reset',
    'emailForgot'     => 'agungsugiarto\boilerplate\Views\Authentication\emails\forgot',
    'emailActivation' => 'agungsugiarto\boilerplate\Views\Authentication\emails\activation',
];
```

Open `app\Config\Filters.php` see at `$aliases` add with below like this.
```php
public $aliases = [
    'login'      => \Myth\Auth\Filters\LoginFilter::class,
    'role'       => \agungsugiarto\boilerplate\Filters\RoleFilter::class,
    'permission' => \agungsugiarto\boilerplate\Filters\PermissionFilter::class,
];
```

**4.** Run publish, migrate and seed boilerplate

```bash
php spark boilerplate:install
```

**5.** Run development server:

```bash
php spark serve
```

**6.** Open in browser http://localhost:8080/admin
```bash
Default user and password
+----+--------+-------------+
| No | User   | Password    |
+----+--------+-------------+
| 1  | admin  | super-admin |
| 2  | user   | super-user  |
+----+--------+-------------+
```

Settings
--------

Config Boilerplate

You can configure default dashboard controller and backend theme in `app\Config\Boilerplate.php`,

```php
class Boilerplate extends BaseConfig
{
    public $appName = 'Boilerplate';

    public $dashboard = [
        'namespace'  => 'agungsugiarto\boilerplate\Controllers',
        'controller' => 'DashboardController::index',
        'filter'     => 'permission:back-office',
    ];
// App/Config/Boilerplate.php
```

Usage
-----
You can find how its work with the read code routes, controller and views etc. Finnaly happy coding!

Changelog
--------
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

Contributing
------------
Contributions are very welcome.

License
-------

This package is free software distributed under the terms of the [MIT license](LICENSE.md).
