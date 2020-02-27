<?php

namespace agungsugiarto\boilerplate\Config;

use CodeIgniter\Config\BaseConfig;

class Boilerplate extends BaseConfig
{
    //--------------------------------------------------------------------------
    // App name
    //--------------------------------------------------------------------------

    public $appName = 'Boilerplate';

    //--------------------------------------------------------------------------
    // Dashboard controller
    //--------------------------------------------------------------------------

    // public $dashboard = [
    //     'namespace' => 'agungsugiarto\boilerplate\Controllers\Users',
    //     'controller' => '',
    //     'role' => '',
    //     'permission' => '',
    // ];

    //--------------------------------------------------------------------------
    // Config cdn for language datatables
    // pelase see https://cdn.datatables.net/plug-ins/1.10.20/i18n/
    //--------------------------------------------------------------------------

    public $i18n = 'Indonesian';

    //--------------------------------------------------------------------------
    // Theme boilerplate
    //
    // BG: blue, indigo, purple, pink, red, orange, yellow, green, teal, cyan,
    //     gray, gray-dark, black
    // Type: dark, light
    // Shadow: 0-4
    //
    //--------------------------------------------------------------------------

    public $theme = [
        'navbar' => [
            'bg'     => 'white',
            'type'   => 'light',
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
                    'bg'     => 'dark',
                    'icon'   => '<i class="fas fa-fire"></i>',
                    'text'   => '<strong>BO</strong>ilerplate',
                    'shadow' => 0,
                ],
            ],
            'user' => [
                'visible' => true,
                'shadow'  => 2,
            ],
        ],
        'footer' => [
            'fixed'      => true,
            'visible'    => true,
            'vendorname' => 'Boilerplate',
            'vendorlink' => 'https://github.com/agungsugiarto/boilerplate',
        ],
    ];
}
