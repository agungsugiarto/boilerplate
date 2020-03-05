<?php

$routes->group('admin', function ($routes) {
    /**
     * User routes.
     **/
    $routes->group('user', [
        'filter'    => 'permission:manage-user',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
    ], function ($routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('show', 'UserController::show');
        $routes->post('create', 'UserController::create');
        $routes->get('edit/(:num)', 'UserController::edit/$1');
        $routes->put('update/(:num)', 'UserController::update/$1');
        $routes->delete('delete/(:num)', 'UserController::delete/$1');
    });
    /**
     * Permission routes.
     */
    $routes->group('permission', [
        'filter'    => 'permission:role-permission',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
    ], function ($routes) {
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
    $routes->group('role', [
        'filter'    => 'permission:role-permission',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
    ], function ($routes) {
        $routes->get('/', 'RoleController::index');
        $routes->post('datatable', 'RoleController::datatable');
        $routes->get('show', 'RoleController::show');
        $routes->post('create', 'RoleController::create');
        $routes->get('edit/(:num)', 'RoleController::edit/$1');
        $routes->get('update', 'RoleController::update/$1');
        $routes->delete('delete/(:num)', 'RoleController::delete/$1');
    });
    /**
     * Role routes.
     */
    $routes->group('menu', [
        'filter'    => 'permission:role-permission',
        'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
    ], function ($routes) {
        $routes->get('/', 'MenuController::index');
        $routes->post('datatable', 'MenuController::datatable');
        $routes->get('show', 'MenuController::show');
        $routes->post('create', 'MenuController::create');
        $routes->get('edit/(:num)', 'MenuController::edit/$1');
        $routes->get('update(:num)', 'MenuController::update/$1');
        $routes->delete('delete/(:num)', 'MenuController::delete/$1');
    });
});
