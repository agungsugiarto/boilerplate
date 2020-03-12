<?php

$routes->group('admin', function ($routes) {

    /**
     * Admin routes.
     **/
    $routes->group('/', [
        'filter'    => config('Boilerplate')->dashboard['filter'],
        'namespace' => config('Boilerplate')->dashboard['namespace'],
    ], function ($routes) {
        $routes->get('/', config('Boilerplate')->dashboard['controller']);
    });

    /**
     * User routes.
     **/
    $routes->group('user', [
        'filter' => 'permission:back-office',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users'
    ], function ($routes) {
        $routes->get('show', 'UserController::show', ['as' => 'user-show']);
        $routes->group('', [
            'filter'    => 'permission:manage-user',
            'namespace' => 'agungsugiarto\boilerplate\Controllers\Users'
        ], function($routes) {
            $routes->get('/', 'UserController::index');
            $routes->post('create', 'UserController::create');
            $routes->get('edit/(:num)', 'UserController::edit/$1');
            $routes->put('update/(:num)', 'UserController::update/$1');
            $routes->delete('delete/(:num)', 'UserController::delete/$1');
        });
    });

    /**
     * Permission routes.
     */
    $routes->resource('permission', [
        'filter'     => 'permission:role-permission',
        'namespace'  => 'agungsugiarto\boilerplate\Controllers\Users',
        'controller' => 'PermissionController',
    ]);

    /**
     * Role routes.
     */
    $routes->group('role', [
        'filter'    => 'permission:role-permission',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
    ], function ($routes) {
        $routes->get('/', 'RoleController::index');
        $routes->post('datatable', 'RoleController::datatable');
        $routes->get('show', 'RoleController::show');
        $routes->post('create', 'RoleController::create');
        $routes->get('edit/(:num)', 'RoleController::edit/$1');
        $routes->post('update/(:num)', 'RoleController::update/$1');
        $routes->delete('delete/(:num)', 'RoleController::delete/$1');
    });

    /**
     * Menu routes.
     */
    $routes->resource('menu', [
        'filter'     => 'permission:role-permission',
        'namespace'  => 'agungsugiarto\boilerplate\Controllers\Users',
        'controller' => 'MenuController',
    ]);
});
