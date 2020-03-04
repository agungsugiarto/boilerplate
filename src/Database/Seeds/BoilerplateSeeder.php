<?php

namespace agungsugiarto\boilerplate\Database\Seeds;

use agungsugiarto\boilerplate\Models\MenuModel;
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
        $this->authorize->createGroup('user', 'User everyday user.');

        // Permission
        $this->authorize->createPermission('back-office', 'User can access to the administration panel.');
        $this->authorize->createPermission('manage-user', 'User can create, delete or modify the users.');
        $this->authorize->createPermission('role-permission', 'User can edit and define permissions for a role.');

        // Assign Permission to role
        $this->authorize->addPermissionToGroup('back-office', 'admin');
        $this->authorize->addPermissionToGroup('manage-user', 'admin');
        $this->authorize->addPermissionToGroup('role-permission', 'admin');
        $this->authorize->addPermissionToGroup('back-office', 'user');

        // Assign Role to user
        $this->authorize->addUserToGroup(1, 1);
        $this->authorize->addUserToGroup(2, 2);

        $this->db->table('menu')->insertBatch([
            [
                'parent_id'  => '0',  
                'title'      => 'Booilerplate',
                'icon'       => 'fa-tachometer-alt',
                'route'      => '#',
                'sequence'   => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '1',
                'title'      => 'User',
                'icon'       => 'fa-circle',
                'route'      => 'admin/user',
                'sequence'   => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '1',
                'title'      => 'Permission',
                'icon'       => 'fa-circle',
                'route'      => 'admin/permission',
                'sequence'   => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '1',
                'title'      => 'Role',
                'icon'       => 'fa-circle',
                'route'      => 'admin/role',
                'sequence'   => '4',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '1',
                'title'      => 'Menu',
                'icon'       => 'fa-circle',
                'route'      => 'admin/menu',
                'sequence'   => '5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }

    public function down()
    {
        // 
    }
}
