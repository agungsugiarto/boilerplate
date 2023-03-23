<?php

namespace agungsugiarto\boilerplate\Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Class Boilerplate.
 */
class Boilerplate extends BaseConfig
{
    // --------------------------------------------------------------------------
    // App name
    // --------------------------------------------------------------------------

    public string $appName = 'Boilerplate';

    // --------------------------------------------------------------------------
    // Dashboard controller
    // --------------------------------------------------------------------------

    public array $dashboard = [
        'namespace'  => 'agungsugiarto\boilerplate\Controllers',
        'controller' => 'DashboardController::index',
        'filter'     => 'permission:back-office',
    ];

    // --------------------------------------------------------------------------
    // Config cdn for language datatables
    // pelase see https://cdn.datatables.net/plug-ins/1.10.20/i18n/
    // --------------------------------------------------------------------------

    public string $i18n = 'English';

    // --------------------------------------------------------------------------
    // Theme boilerplate
    //
    // Auto switch Dark/Light mode: true,false
    // BG: blue, indigo, purple, pink, red, orange, yellow, green, teal, cyan,
    //     gray, gray-dark, black
    // Type: dark, light
    // Shadow: 0-4
    //
    // --------------------------------------------------------------------------

    public array $theme = [
        'dark-mode' => true,
        'body-sm'   => false,
        'navbar'    => [
            'bg'     => '',
            'type'   => '',
            'border' => true,
            'user'   => [
                'visible' => true,
                'shadow'  => 0,
            ],
        ],
        'sidebar' => [
            'type'    => 'dark',
            'shadow'  => 4,
            'border'  => false,
            'compact' => true,
            'links'   => [
                'bg'     => 'blue',
                'shadow' => 1,
            ],
            'brand' => [
                'bg'   => 'gray-dark',
                'logo' => [
                    'icon'   => 'favicon.ico', // path to image | this example icon on public root folder.
                    'shadow' => 2,
                    'circle' => false,
                ],
            ],
            'user' => [
                'visible' => true,
                'shadow'  => 2,
            ],
        ],
        'footer' => [
            'fixed'      => false,
            'vendorname' => 'Your Awesome Vendor',
            'vendorlink' => 'https://your-awesome.com',
        ],
    ];
}
