<?php

namespace julio101290\boilerplate\Controllers\Users;

use julio101290\boilerplate\Controllers\BaseController;
use julio101290\boilerplate\Entities\Collection;
use julio101290\boilerplate\Models\GroupModel;
use julio101290\boilerplate\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Authorization\PermissionModel;
use Myth\Auth\Entities\User;

/**
 * Class UserController.
 */
class UserController extends BaseController
{
    use ResponseTrait;

    /** @var \julio101290\boilerplate\Models\UserModel */
    protected $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            $start = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $order = UserModel::ORDERABLE[$this->request->getGet('order[0][column]')];
            $dir = $this->request->getGet('order[0][dir]');

            return $this->respond(Collection::datatable(
                $this->users->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
                $this->users->getResource()->countAllResults(),
                $this->users->getResource($search)->countAllResults()
            ));
        }

        return view('julio101290\boilerplate\Views\User\index', [
            'title'    => lang('boilerplate.user.title'),
            'subtitle' => lang('boilerplate.user.subtitle'),
        ]);
    }

    /**
     * Show profile user or update.
     *
     * @return mixed
     */
    public function profile()
    {
        if ($this->request->getMethod() === 'post') {
            $id = user()->id;
            $validationRules = [
                'email'        => "required|valid_email|is_unique[users.email,id,$id]",
                'username'     => "required|alpha_numeric_space|min_length[3]|is_unique[users.username,id,$id]",
                'password'     => 'if_exist',
                'pass_confirm' => 'matches[password]',
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

            $user = new User();

            if ($this->request->getPost('password')) {
                $user->password = $this->request->getPost('password');
            }

            $user->email = $this->request->getPost('email');
            $user->username = $this->request->getPost('username');

            if ($this->users->skipValidation(true)->update(user()->id, $user)) {
                return redirect()->back()->with('sweet-success', lang('boilerplate.user.msg.msg_update'));
            }

            return redirect()->back()->withInput()->with('sweet-error', lang('boilerplate.user.msg.msg_get_fail'));
        }

        return view('julio101290\boilerplate\Views\User\profile', [
            'title' => lang('boilerplate.user.fields.profile'),
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return mixed
     */
    public function new()
    {
        return view('julio101290\boilerplate\Views\User\create', [
            'title'       => lang('boilerplate.user.title'),
            'subtitle'    => lang('boilerplate.user.add'),
            'permissions' => $this->authorize->permissions(),
            'roles'       => $this->authorize->groups(),
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return mixed
     */
    public function create()
    {
        $validationRules = [
            'active'       => 'required',
            'username'     => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
            'permission'   => 'required',
            'role'         => 'required',
        ];

        $permissions = $this->request->getPost('permission');
        $roles = $this->request->getPost('role');

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $this->db->transBegin();

        try {
            $id = $this->users->insert(new User([
                'active'   => $this->request->getPost('active'),
                'email'    => $this->request->getPost('email'),
                'firstname'    => $this->request->getPost('firstname'),
                'lastname'    => $this->request->getPost('lastname'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ]));

            foreach ($permissions as $permission) {
                $this->authorize->addPermissionToUser($permission, $id);
            }

            foreach ($roles as $role) {
                $this->authorize->addUserToGroup($id, $role);
            }

            $this->db->transCommit();
        } catch (\Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }

        return redirect()->back()->with('sweet-success', lang('boileplate.user.msg.msg_insert'));
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int id
     *
     * @return mixed
     */
    public function edit($id)
    {
        $data = [
            'title'       => lang('boilerplate.user.title'),
            'subtitle'    => lang('boilerplate.user.edit'),
            'permissions' => $this->authorize->permissions(),
            'permission'  => (new PermissionModel())->getPermissionsForUser($id),
            'roles'       => $this->authorize->groups(),
            'role'        => (new GroupModel())->getGroupsForUser($id),
            'user'        => $this->users->asArray()->find($id),
        ];

        return view('julio101290\boilerplate\Views\User\update', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int id
     *
     * @return mixed
     */
    public function update($id)
    {
        $validationRules = [
            'active'       => 'required',
            'username'     => "required|alpha_numeric_space|min_length[3]|is_unique[users.username,id,$id]",
            'email'        => "required|valid_email|is_unique[users.email,id,$id]",
            'password'     => 'if_exist',
            'pass_confirm' => 'matches[password]',
            'permission'   => 'if_exist',
            'role'         => 'if_exist',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $this->db->transBegin();

        try {
            $user = new User();

            if ($this->request->getPost('password')) {
                $user->password = $this->request->getPost('password');
            }

            $user->active = $this->request->getPost('active');
            $user->email = $this->request->getPost('email');
            $user->username = $this->request->getPost('username');
            $user->firstname = $this->request->getPost('firstname');
            $user->lastname = $this->request->getPost('lastname');

            $this->users->skipValidation(true)->update($id, $user);

            // delete first permission from user
            $this->db->table('auth_users_permissions')->where('user_id', $id)->delete();

            foreach ($this->request->getPost('permission') as $permission) {
                // insert with new permission
                $this->authorize->addPermissionToUser($permission, $id);
            }

            // delete first groups from user
            $this->db->table('auth_groups_users')->where('user_id', $id)->delete();

            foreach ($this->request->getPost('role') as $role) {
                // insert with new role
                $this->authorize->addUserToGroup($id, $role);
            }

            $this->db->transCommit();
        } catch (\Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }

        return redirect()->back()->with('sweet-success', lang('boilerplate.user.msg.msg_update'));
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int id
     *
     * @return mixed
     */
    public function delete($id)
    {
        if (!$found = $this->users->delete($id)) {
            return $this->failNotFound(lang('boilerplate.user.msg.msg_get_fail'));
        }

        return $this->respondDeleted($found, lang('boilerplate.user.msg.msg_delete'));
    }
}
