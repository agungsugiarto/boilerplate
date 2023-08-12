<?php

namespace julio101290\boilerplate\Controllers\Users;

use julio101290\boilerplate\Controllers\BaseController;
use julio101290\boilerplate\Entities\Collection;
use julio101290\boilerplate\Models\PermissionModel;
use CodeIgniter\API\ResponseTrait;

/**
 * Class PermissionController.
 */
class PermissionController extends BaseController
{
    use ResponseTrait;

    /** @var \julio101290\boilerplate\Models\PermissionModel */
    protected $permission;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->permission = new PermissionModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return View | \CodeIgniter\API\ResponseTrait
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            $start = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $order = PermissionModel::ORDERABLE[$this->request->getGet('order[0][column]')];
            $dir = $this->request->getGet('order[0][dir]');

            return $this->respond(Collection::datatable(
                $this->permission->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
                $this->permission->getResource()->countAllResults(),
                $this->permission->getResource($search)->countAllResults()
            ));
        }

        return view('julio101290\boilerplate\Views\Permission\index', [
            'title'    => lang('boilerplate.permission.title'),
            'subtitle' => lang('boilerplate.permission.subtitle'),
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return array an array
     */
    public function create()
    {
        if (!$data = $this->permission->save($this->request->getPost())) {
            return $this->fail($this->permission->errors());
        }

        return $this->respondCreated($data, lang('boilerplate.permission.msg.msg_insert'));
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
        if (!$found = $this->permission->find($id)) {
            return $this->failNotFound(lang('boilerplate.permission.msg.msg_get_fail', [$id]));
        }

        return $this->respond(['data' => $found], 200, lang('boilerplate.permission.msg.msg_get', [$id]));
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
        if (!$result = $this->permission->update($id, $this->request->getRawInput())) {
            return $this->fail($this->permission->errors());
        }

        return $this->respondUpdated($result, lang('boilerplate.permission.msg.msg_update', [$id]));
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
        if (!$this->permission->delete($id)) {
            return $this->failNotFound(lang('boilerplate.permission.msg.msg_get_fail', [$id]));
        }

        return $this->respondDeleted(['id' => $id], lang('boilerplate.permission.msg.msg_delete', [$id]));
    }
}
