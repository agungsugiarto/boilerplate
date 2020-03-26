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
        'filter'    => 'permission:back-office',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
    ], function ($routes) {
        $routes->match(['get', 'post'], 'profile', 'UserController::profile', ['as' => 'user-profile']);
        $routes->post('(.*)/update', 'UserController::update/$1', ['as' => 'user-update']);
        $routes->resource('manage', [
            'filter'     => 'permission:manage-user',
            'namespace'  => 'agungsugiarto\boilerplate\Controllers\Users',
            'controller' => 'UserController',
            'except'     => 'update',
        ]);
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
        $routes->get('new', 'RoleController::new');
        $routes->get('(.*)/show', 'RoleController::show/$1');
        $routes->post('', 'RoleController::create');
        $routes->get('(.*)/edit', 'RoleController::edit/$1');
        $routes->post('(.*)/update', 'RoleController::update/$1', ['as' => 'role-update']);
        $routes->delete('(.*)', 'RoleController::delete/$1');
    });

    /**
     * Menu routes.
     */
    $routes->resource('menu', [
        'filter'     => 'permission:menu-permission',
        'namespace'  => 'agungsugiarto\boilerplate\Controllers\Users',
        'controller' => 'MenuController',
        'except'     => 'new',
    ]);

    $routes->put('menu-update', 'MenuController::new', [
        'filter'    => 'permission:menu-permission',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
        'as'        => 'menu-update',
    ]);
});
