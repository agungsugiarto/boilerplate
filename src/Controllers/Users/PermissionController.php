<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;
use agungsugiarto\boilerplate\Entities\Collection;
use agungsugiarto\boilerplate\Models\PermissionModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

/**
 * Class PermissionController.
 */
class PermissionController extends BaseController
{
    use ResponseTrait;

    /** @var PermissionModel */
    protected PermissionModel $permission;

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
     * @return ResponseInterface|string
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

        return view('agungsugiarto\boilerplate\Views\Permission\index', [
            'title'    => lang('boilerplate.permission.title'),
            'subtitle' => lang('boilerplate.permission.subtitle'),
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function create(): ResponseInterface
    {
        if (!$this->permission->save($this->request->getPost())) {
            return $this->fail($this->permission->errors());
        }

        return $this->respondCreated(null, lang('boilerplate.permission.msg.msg_insert'));
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|null $id
     *
     * @return ResponseInterface
     */
    public function edit(?int $id = null): ResponseInterface
    {
        if (!$found = $this->permission->find($id)) {
            return $this->failNotFound(lang('boilerplate.permission.msg.msg_get_fail', [$id]));
        }

        return $this->respond(['data' => $found], 200, lang('boilerplate.permission.msg.msg_get', [$id]));
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|null $id
     *
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function update(?int $id = null): ResponseInterface
    {
        if (!$this->permission->update($id, $this->request->getRawInput())) {
            return $this->fail($this->permission->errors());
        }

        return $this->respondUpdated(null, lang('boilerplate.permission.msg.msg_update', [$id]));
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|null $id
     *
     * @return ResponseInterface
     */
    public function delete(?int $id = null): ResponseInterface
    {
        if (!$this->permission->delete($id)) {
            return $this->failNotFound(lang('boilerplate.permission.msg.msg_get_fail', [$id]));
        }

        return $this->respondDeleted(['id' => $id], lang('boilerplate.permission.msg.msg_delete', [$id]));
    }
}
