<?php

return [
    'global' => [
        'save' => 'Save',
        'close' => 'Close',
        'action' => 'Action',
        'logout' => 'Logout',
        'search' => 'Search',
        'sweet' => [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'confirm_delete' => 'Yes, delete it!',
        ],
    ],
    /**
     * Permission.
     */
    'permission' => [
        'add' => 'Add permission',
        'edit' => 'Edit permission',
        'title' => 'Permission management',
        'subtitle' => 'Permission list',
        'fields' => [
            'name' => 'Permission',
            'description' => 'Description',
            'plc_name' => 'Name of permission',
            'plc_description' => 'Description for permission',
        ],
        'msg' => [
            'msg_insert' => 'The permission has been correctly added.',
            'msg_update' => 'The permission id {0} has been correctly modified.',
            'msg_delete' => 'The permission id {0} has been correctly deleted.',
            'msg_get' => 'The permission id {0} has been successfully get.',
            'msg_get_fail' => 'The permission id {0} not found or already deleted.',
        ],
    ],
    /**
     * Role.
     */
    'role' => [
        'add' => 'Add role',
        'edit' => 'Edit role',
        'title' => 'Role management',
        'subtitle' => 'Role list',
        'fields' => [
            'name' => 'Role',
            'description' => 'Description',
            'plc_name' => 'Name of role',
            'plc_description' => 'Description for role',
        ],
        'msg' => [
            'msg_insert' => 'The role has been correctly added.',
            'msg_update' => 'The role id {0} has been correctly modified.',
            'msg_delete' => 'The role id {0} has been correctly deleted.',
            'msg_get' => 'The role id {0} has been successfully get.',
            'msg_get_fail' => 'The role id {0} not found or already deleted.',
        ],
    ],
    /**
     * Menu.
     */
    'menu' => [
        'expand' => 'Expand',
        'collapse' => 'Collapse',
        'refresh' => 'Refresh',
        'add' => 'Add menu',
        'edit' => 'Edit menu',
        'title' => 'Menu management',
        'subtitle' => 'Menu list',
        'fields' => [
            'parent' => 'Parent',
            'warning_parent' => 'Please note! the menu only support with max depth 2.',
            'active' => 'Active',
            'non_active' => 'Non Active',
            'icon' => 'Icon',
            'info_icon' => 'For more icons, please see',
            'place_icon' => 'Icon from fontawesome.',
            'name' => 'Title',
            'place_title' => 'Name for menu.',
            'route' => 'Route',
            'place_route' => 'Route for link menu.',
        ],
        'msg' => [
            'msg_insert' => 'The menu has been correctly added.',
            'msg_update' => 'The menu has been correctly modified.',
            'msg_delete' => 'The menu has been correctly deleted.',
            'msg_get' => 'The menu has been successfully get.',
            'msg_get_fail' => 'The menu not found or already deleted.',
            'msg_fail_order' => 'The menu failed the reorder.',
        ],
    ],
    /**
     * user.
     */
    'user' => [
        'add' => 'Add user',
        'edit' => 'Edit user',
        'title' => 'User management',
        'subtitle' => 'User list',
        'lastname' => 'Last name',
        'firstname' => 'First Name',
        'fields' => [
            'active' => 'Active',
            'profile' => 'Profile',
            'join' => 'Member since',
            'setting' => 'Setting',
            'non_active' => 'Non Active',
        ],
        'msg' => [
            'msg_insert' => 'The user has been correctly added.',
            'msg_update' => 'The user has been correctly modified.',
            'msg_delete' => 'The user has been correctly deleted.',
            'msg_get' => 'The user has been successfully get.',
            'msg_get_fail' => 'The user not found or already deleted.',
        ],
    ],
];
