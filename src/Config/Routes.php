<?php

$routes->group('dashboard', ['namespace' => 'agungsugiarto\boilerplate\Controllers\Users'], function ($routes) {
    $routes->get('/', 'MenuController::index');
    // do your own routes
});

$routes->group('admin', function ($routes) {
    /**
     * User routes.
     **/
    $routes->group('user', ['namespace' => 'agungsugiarto\boilerplate\Controllers\Users'], ['filter' => 'role:admin'], function ($routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('show', 'UserController::show');
        $routes->get('create', 'UserController::create');
        $routes->get('edit', 'UserController::edit');
        $routes->get('update', 'UserController::update');
        $routes->get('delete', 'UserController::delete');
    });

    /**
     * Permission routes.
     */
    $routes->group('permission', ['namespace' => 'agungsugiarto\boilerplate\Controllers\Users'], ['filter' => 'role:admin'], function ($routes) {
        $routes->get('/', 'PermissionController::index');
        $routes->get('show', 'PermissionController::show');
        $routes->post('create', 'PermissionController::create');
        $routes->get('edit/(:num)', 'PermissionController::edit/$1');
        $routes->put('update/(:num)', 'PermissionController::update/$1');
        $routes->delete('delete/(:num)', 'PermissionController::delete/$1');
    });

    /**
     * Role routes.
     */
    $routes->group('role', ['namespace' => 'agungsugiarto\boilerplate\Controllers\Users'], ['filter' => 'role:admin'], function ($routes) {
        $routes->get('/', 'RoleController::index');
        $routes->post('datatable', 'RoleController::datatable');
        $routes->get('show', 'RoleController::show');
        $routes->post('create', 'RoleController::create');
        $routes->get('edit/(:num)', 'RoleController::edit/$1');
        $routes->get('update', 'RoleController::update');
        $routes->delete('delete/(:num)', 'RoleController::delete/$1');
    });

    /**
     * Role routes.
     */
    $routes->group('menu', ['namespace' => 'agungsugiarto\boilerplate\Controllers\Users'], ['filter' => 'role:admin'], function ($routes) {
        $routes->get('/', 'MenuController::index');
    });
});
