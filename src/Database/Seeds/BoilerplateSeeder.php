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
     * @var Users
     */
    protected $users;

    public function __construct()
    {
        $this->authorize = Services::authorization();
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
    }

    public function down()
    {
        // Assign
        $this->authorize->removePermissionFromGroup('back-office', 'admin');
        $this->authorize->removePermissionFromGroup('manage-user', 'admin');
        $this->authorize->removePermissionFromGroup('role-permission', 'admin');
        $this->authorize->removePermissionFromGroup('back-office', 'user');

        //Role
        $this->authorize->deleteGroup(['1', '2']);

        // Permission
        $this->authorize->deletePermission(['1', '2', '3']);

        // Remove Role to user
        $this->authorize->removeUserFromGroup(1, 'admin');
        $this->authorize->removeUserFromGroup(2, 'user');
    }
}
