<?php

namespace agungsugiarto\boilerplate\Database\Seeds;

use CodeIgniter\Config\Services;
use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class BoilerplateSeeder extends Seeder
{
    /**
     * @var Authorize
     */
    protected $authorize;

    /**
     * @var Db
     */
    protected $db;

    /**
     * @var Users
     */
    protected $users;

    public function __construct()
    {
        $this->authorize = Services::authorization();
        $this->db = \Config\Database::connect();
        $this->users = new UserModel();
    }

    public function run()
    {
        // User
        $this->users->save(new User([
            'email'    => 'admin@admin.com',
            'username' => 'admin',
            'password' => 'super-admin',
            'active'   => '1',
        ]));

        $this->users->save(new User([
            'email'    => 'user@user.com',
            'username' => 'user',
            'password' => 'super-user',
            'active'   => '1',
        ]));

        // Role
        $this->authorize->createGroup('admin', 'Administrators. The top of the food chain.');
        $this->authorize->createGroup('member', 'Member everyday member.');

        // Permission
        $this->authorize->createPermission('back-office', 'User can access to the administration panel.');
        $this->authorize->createPermission('manage-user', 'User can create, delete or modify the users.');
        $this->authorize->createPermission('role-permission', 'User can edit and define permissions for a role.');

        // Assign Permission to role
        $this->authorize->addPermissionToGroup('back-office', 'admin');
        $this->authorize->addPermissionToGroup('manage-user', 'admin');
        $this->authorize->addPermissionToGroup('role-permission', 'admin');
        $this->authorize->addPermissionToGroup('back-office', 'member');

        // Assign Role to user
        $this->authorize->addUserToGroup(1, 'admin');
        $this->authorize->addUserToGroup(1, 'member');
        $this->authorize->addUserToGroup(2, 'member');

        // Assign Permission to user
        $this->authorize->addPermissionToUser('back-office', 1);
        $this->authorize->addPermissionToUser('manage-user', 1);
        $this->authorize->addPermissionToUser('role-permission', 1);
        $this->authorize->addPermissionToUser('back-office', 2);

        $this->db->table('menu')->insertBatch([
            [
                'parent_id'  => '0',
                'title'      => 'Dashboard',
                'icon'       => 'fa-home',
                'route'      => 'admin',
                'sequence'   => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '0',
                'title'      => 'Authentication',
                'icon'       => 'fa-tachometer-alt',
                'route'      => '#',
                'sequence'   => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'User',
                'icon'       => 'fa-circle',
                'route'      => 'admin/user',
                'sequence'   => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'Permission',
                'icon'       => 'fa-circle',
                'route'      => 'admin/permission',
                'sequence'   => '4',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'Role',
                'icon'       => 'fa-circle',
                'route'      => 'admin/role',
                'sequence'   => '5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'Menu',
                'icon'       => 'fa-circle',
                'route'      => 'admin/menu',
                'sequence'   => '6',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        $this->db->table('groups_menu')->insertBatch([
            [
                'group_id' => 1,
                'menu_id'  => 1,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 2,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 3,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 4,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 5,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 6,
            ],
            [
                'group_id' => 2,
                'menu_id'  => 1,
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
