<p align="center">
<a href="https://packagist.org/packages/julio101290/boilerplate"><img src="https://poser.pugx.org/julio101290/boilerplate/version"></a>
<a href="https://packagist.org/packages/julio101290/boilerplate"><img src="https://img.shields.io/badge/Package-julio101290%2Fboilerplate-light.svg"></a>
<a href="https://packagist.org/packages/julio101290/boilerplate"><img src="https://poser.pugx.org/julio101290/boilerplate/downloads"</img></a>
<a href="https://github.com/julio101290/boilerplate/blob/master/LICENSE.md"><img src="https://img.shields.io/github/license/julio101290/boilerplate"></a>
</p>

CodeIgniter 4 Application Boilerplate
=====================================
This package for CodeIgniter 4 serves as a basic platform for quickly creating a back-office application. It includes profile creation and management, user management, roles, permissions and a dynamically-generated menu.

Feature
-------
* Configurable backend theme [AdminLTE 3](https://adminlte.io/docs/3.0/)
* CSS framework [Bootstrap 4](https://getbootstrap.com/)
* Icons by [Font Awesome 5](https://fontawesome.com/)
* Role-based permissions (RBAC) provided by [Myth/Auth](https://github.com/lonnieezell/myth-auth)
* Dynamically-Generated Menu
* Localized English / Indonesian / Spanish

This project is still early in its development... please feel free to contribute!

The original author is agungsugiarto/boilerplate https://github.com/agungsugiarto/boilerplate, we only made a fork to adapt it to new needs such as translating it into Spanish and making it functional in xampp/lampp

![Dashboard](.github/dashboard.png?raw=true)

------------------------------------------------------------

-------------------------------------------------------------------------------


Installation
------------

**1.** Get The Module

```bash
composer require julio101290/boilerplate
```

**2.** Set CI_ENVIRONMENT, baseURL, index page, and database config in your `.env` file based on your existing database (If you don't have a `.env` file, you can copy first from `env` file: `cp env .env` first). If the database does not exist, create the database first.

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


Is it ready yet? Not so fast!! ;-) After publishing `Config/Auth.php` you need to change
`public $views` with these lines below:
```php
public $views = [
    'login'           => 'julio101290\boilerplate\Views\Authentication\login',
    'register'        => 'julio101290\boilerplate\Views\Authentication\register',
    'forgot'          => 'julio101290\boilerplate\Views\Authentication\forgot',
    'reset'           => 'julio101290\boilerplate\Views\Authentication\reset',
    'emailForgot'     => 'julio101290\boilerplate\Views\Authentication\emails\forgot',
    'emailActivation' => 'julio101290\boilerplate\Views\Authentication\emails\activation',
];
```

Open `app\Config\Filters.php`, find `$aliases` and add these lines below:
```php
public $aliases = [
    'login'      => \Myth\Auth\Filters\LoginFilter::class,
    'role'       => \julio101290\boilerplate\Filters\RoleFilter::class,
    'permission' => \julio101290\boilerplate\Filters\PermissionFilter::class,
];
```

**4.** Run publish, migrate and seed boilerplate

```bash
php spark boilerplate:install
```
Open `app\Config\validation.php`, find `$ruleSets` and add these lines below:

```php
public $$ruleSets = [
    \Myth\Auth\Authentication\Passwords\ValidationRules::class,
];
```
Open `app\entities\Users.php`, find `$casts` and add these lines below:

```php

    protected $casts = [
        'username' => 'string',
        'email' => 'string',
        'firstname' => 'string',
        'lastname' => 'string',
        'active' => 'boolean',
        'force_pass_reset' => 'boolean',
    ];

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
        'namespace'  => 'julio101290\boilerplate\Controllers',
        'controller' => 'DashboardController::index',
        'filter'     => 'permission:back-office',
    ];
// App/Config/Boilerplate.php
```

Usage
-----
You can find how it works with the read code routes, controller and views etc. Finnally... Happy Coding!

Changelog
--------
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

Contributing
------------
Contributions are very welcome.

License
-------

This package is free software distributed under the terms of the [MIT license](LICENSE.md).
