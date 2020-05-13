<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Entities\Collection;
use agungsugiarto\boilerplate\Models\PermissionModel;
use CodeIgniter\RESTful\ResourceController;

/**
 * Class PermissionController.
 */
class PermissionController extends ResourceController
{
    protected $modelName = PermissionModel::class;
    protected $format = 'json';

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        helper('menu');
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return View | \CodeIgniter\API\ResponseTrait
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            $columns = [
                1 => 'name',
                2 => 'description',
            ];

            $start = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $order = $columns[$this->request->getGet('order[0][column]')];
            $dir = $this->request->getGet('order[0][dir]');

            return $this->respond(Collection::datatable(
                model(PermissionModel::class)->findPaginatedData($order, $dir, $length, $start, $search),
                model(PermissionModel::class)->countAllResults(),
                model(PermissionModel::class)->countFindData($search)
            ));
        }

        return view('agungsugiarto\boilerplate\Views\Permission\index', [
            'title'    => lang('boilerplate.permission.title'),
            'subtitle' => lang('boilerplate.permission.subtitle'),
        ]);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int $id
     *
     * @return array an array
     */
    public function show($id = null)
    {
        if (!$record = $this->model->find($id)) {
            return $this->failNotFound(lang('boilerplate.permission.msg.msg_get_fail', [$id]));
        }

        return $this->respond(['data' => $record]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return array an array
     */
    public function new()
    {
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return array an array
     */
    public function create()
    {
        if (!$data = $this->model->save($this->request->getPost())) {
            return $this->fail($this->model->errors());
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
        if (!$found = $this->model->find($id)) {
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
        if (!$result = $this->model->update($id, $this->request->getRawInput())) {
            return $this->fail($this->model->errors());
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
        if (!$this->model->delete($id)) {
            return $this->failNotFound(lang('boilerplate.permission.msg.msg_get_fail', [$id]));
        }

        return $this->respondDeleted(['id' => $id], lang('boilerplate.permission.msg.msg_delete', [$id]));
    }
}
