<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;
use agungsugiarto\boilerplate\Entities\Collection;
use agungsugiarto\boilerplate\Models\GroupModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

/**
 * Class RoleController.
 */
class RoleController extends BaseController
{
    use ResponseTrait;

    protected GroupModel $group;

    public function __construct()
    {
        $this->group = new GroupModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface|string
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            $start  = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $order  = GroupModel::ORDERABLE[$this->request->getGet('order[0][column]')];
            $dir    = $this->request->getGet('order[0][dir]');

            return $this->respond(Collection::datatable(
                $this->group->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
                $this->group->getResource()->countAllResults(),
                $this->group->getResource($search)->countAllResults()
            ));
        }

        return view('agungsugiarto\boilerplate\Views\Role\index', [
            'title'    => lang('boilerplate.role.title'),
            'subtitle' => lang('boilerplate.role.subtitle'),
            'data'     => $this->authorize->permissions(),
        ]);
    }

    /**
     * Return a new resource object, with default properties.
     */
    public function new(): string
    {
        $data = [
            'title'    => lang('boilerplate.role.title'),
            'subtitle' => lang('boilerplate.role.add'),
            'data'     => $this->authorize->permissions(),
        ];

        return view('agungsugiarto\boilerplate\Views\Role\create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     */
    public function create(): RedirectResponse
    {
        $validationRules = [
            'name'        => 'required|min_length[5]|max_length[255]|is_unique[auth_groups.name]',
            'description' => 'required|max_length[255]',
            'permission'  => 'required',
        ];

        $name        = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $permission  = $this->request->getPost('permission');

        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $this->db->transBegin();

        try {
            $id = $this->authorize->createGroup(url_title($name), $description);

            foreach ($permission as $value) {
                $this->authorize->addPermissionToGroup($value, $id);
            }

            $this->db->transCommit();
        } catch (Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }

        return redirect()->back()->with('sweet-success', lang('boilerplate.role.msg.msg_insert'));
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @return RedirectResponse|string
     */
    public function edit(?int $id = null)
    {
        if (null === $this->authorize->group($id)) {
            return redirect()->back()->with('sweet-error', lang('boilerplate.role.msg.msg_get_fail', [$id]));
        }

        $data = [
            'title'       => lang('boilerplate.role.title'),
            'subtitle'    => lang('boilerplate.role.edit'),
            'role'        => $this->authorize->group($id),
            'permissions' => $this->authorize->permissions(),
            'permission'  => $this->authorize->groupPermissions($id),
        ];

        return view('agungsugiarto\boilerplate\Views\Role\edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @return RedirectResponse|string
     */
    public function update(?int $id = null)
    {
        $validationRules = [
            'name'        => 'required|min_length[5]|max_length[255]',
            'description' => 'required|max_length[255]',
            'permission'  => 'required',
        ];

        $name        = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $permission  = $this->request->getPost('permission');

        if (! $this->validate($validationRules)) {
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
        } catch (Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }

        return redirect()->back()->with('sweet-success', lang('boilerplate.role.msg.msg_update', [$id]));
    }

    /**
     * Delete the designated resource object from the model.
     */
    public function delete(?int $id = null): ResponseInterface
    {
        if (! $this->authorize->deleteGroup($id)) {
            return $this->failNotFound(lang('boilerplate.role.msg.msg_get_fail', [$id]));
        }

        return $this->respondDeleted(['id' => $id], lang('boilerplate.role.msg.msg_delete', [$id]));
    }
}
