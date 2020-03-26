<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

/**
 * Class UserController.
 */
class UserController extends BaseController
{
    use ResponseTrait;

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
        $data = [
            'title' => lang('user.title'),
        ];

        if ($this->request->isAJAX()) {
            return $this->respond([
                'data' => $this->users->asObject()->findAll(),
            ]);
        }

        return view('agungsugiarto\boilerplate\Views\User\index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int id
     *
     * @return mixed
     */
    public function show($id)
    {
        if ($this->request->isAJAX()) {
            $group = new GroupModel();

            $userGroups = $group->getGroupsForUser($id);
            $user = $this->users->where('id', $id)->get()->getResultArray();

            if (!$user) {
                return $this->fail('fail get data');
            }

            return $this->respond([
                'data' => [
                    'user'   => $user,
                    'groups' => $userGroups,
                ],
            ], 200);
        }
    }

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
                return redirect()->back()->with('success', 'success');
            }

            return redirect()->back()->withInput()->with('error', $this->users->getErrors());
        }

        return view('agungsugiarto\boilerplate\Views\User\profile');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'title'       => lang('user.title'),
            'permissions' => $this->authorize->permissions(),
            'roles'       => $this->authorize->groups(),
        ];

        return view('agungsugiarto\boilerplate\Views\User\create', $data);
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

        try {
            $this->db->transBegin();

            $id = $this->users->insert(new User([
                'active'   => $this->request->getPost('active'),
                'email'    => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ]));

            foreach ($permissions as $permission) {
                $this->authorize->addPermissionToUser($permission, $id);
            }

            foreach ($roles as $role) {
                $this->authorize->addUserToGroup($id, $role);
            }
        } catch (\Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('errors', $e->getMessage());
        }

        $this->db->transCommit();

        return redirect()->back()->with('messages', 'success insert data!');
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
            'title'       => lang('user.title'),
            'permissions' => $this->authorize->permissions(),
            'roles'       => $this->authorize->groups(),
            'user'        => $this->users->find($id)->toArray(),
        ];

        // dd($data['user']);

        return view('agungsugiarto\boilerplate\Views\User\update', $data);
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
            'username'     => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
            'permission'   => 'required',
            'role'         => 'required',
        ];

        $permissions = $this->request->getGet('permission');
        $roles = $this->request->getGet('role');

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        try {
            $this->db->transBegin();

            $id = $this->users->update(new User([
                'active'   => $this->request->getGet('active'),
                'email'    => $this->request->getGet('email'),
                'username' => $this->request->getGet('username'),
                'password' => $this->request->getGet('password'),
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

            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->back()->with('messages', 'success update data!');
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
        if (!$found = $this->users->where('id', $id)->delete()) {
            return $this->fail('fail deleted');
        }

        return $this->respondDeleted($found);
    }

    private function listAllUser()
    {
        $users = $this->users->get()->getResultObject();
        $data = [];

        foreach ($users as $item) {
            $user['active'] = $item->active;
            $user['username'] = $item->username;
            $user['email'] = $item->email;
            $user['created_at'] = $item->created_at;
            $user['groups'] = (new GroupModel())->getGroupsForUser($item->id);

            $data[] = $user;
        }

        return $data;
    }
}
