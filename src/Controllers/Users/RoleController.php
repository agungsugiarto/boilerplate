<?php

namespace julio101290\boilerplate\Controllers\Users;

use julio101290\boilerplate\Controllers\BaseController;
use julio101290\boilerplate\Entities\Collection;
use julio101290\boilerplate\Models\GroupModel;
use CodeIgniter\API\ResponseTrait;

/**
 * Class RoleController.
 */
class RoleController extends BaseController
{
    use ResponseTrait;

    /** @var \julio101290\boilerplate\Models\GroupModel */
    protected $group;

    public function __construct()
    {
        $this->group = new GroupModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return array an array
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            $start = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $order = GroupModel::ORDERABLE[$this->request->getGet('order[0][column]')];
            $dir = $this->request->getGet('order[0][dir]');

            return $this->respond(Collection::datatable(
                $this->group->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
                $this->group->getResource()->countAllResults(),
                $this->group->getResource($search)->countAllResults()
            ));
        }

        return view('julio101290\boilerplate\Views\Role\index', [
            'title'    => lang('boilerplate.role.title'),
            'subtitle' => lang('boilerplate.role.subtitle'),
            'data'     => $this->authorize->permissions(),
        ]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return array an array
     */
    public function new()
    {
        $data = [
            'title'    => lang('boilerplate.role.title'),
            'subtitle' => lang('boilerplate.role.add'),
            'data'     => $this->authorize->permissions(),
        ];

        return view('julio101290\boilerplate\Views\Role\create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return array an array
     */
    public function create()
    {
        $validationRules = [
            'name'        => 'required|min_length[5]|max_length[255]|is_unique[auth_groups.name]',
            'description' => 'required|max_length[255]',
            'permission'  => 'required',
        ];

        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $permission = $this->request->getPost('permission');

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $this->db->transBegin();

        try {
            $id = $this->authorize->createGroup(url_title($name), $description);

            foreach ($permission as $value) {
                $this->authorize->addPermissionToGroup($value, $id);
            }

            $this->db->transCommit();
        } catch (\Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }

        return redirect()->back()->with('sweet-success', lang('boilerplate.role.msg.msg_insert'));
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int $id
     *
     * @return array an array
     */
    public function edit($id = null)
    {
        if (is_null($this->authorize->group($id))) {
            return redirect()->back()->with('sweet-error', lang('boilerplate.role.msg.msg_get_fail', [$id]));
        }

        $data = [
            'title'        => lang('boilerplate.role.title'),
            'subtitle'     => lang('boilerplate.role.edit'),
            'role'         => $this->authorize->group($id),
            'permissions'  => $this->authorize->permissions(),
            'permission'   => $this->authorize->groupPermissions($id),
        ];

        return view('julio101290\boilerplate\Views\Role\edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int $id
     *
     * @return array an array
     */
    public function update($id = null)
    {
        $validationRules = [
            'name'        => 'required|min_length[5]|max_length[255]',
            'description' => 'required|max_length[255]',
            'permission'  => 'required',
        ];

        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $permission = $this->request->getPost('permission');

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $this->db->transBegin();

        try {
            // update group
            $this->authorize->updateGroup($id, url_title($name), $description);

            // remove first all groups permissions
            $this->db->table('auth_groups_permissions')->where('group_id', $id)->delete();

            foreach ($permission as $value) {
                // insert with new permission to group
                $this->authorize->addPermissionToGroup($value, $id);
            }

            $this->db->transCommit();
        } catch (\Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }

        return redirect()->back()->with('sweet-success', lang('boilerplate.role.msg.msg_update', [$id]));
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int $id
     *
     * @return array an array
     */
    public function delete($id = null)
    {
        if (!$found = $this->authorize->deleteGroup($id)) {
            return $this->failNotFound(lang('boilerplate.role.msg.msg_get_fail', [$id]));
        }

        return $this->respondDeleted($found, lang('boilerplate.role.msg.msg_delete', [$id]));
    }
}
