<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;

class PermissionController extends BaseController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return array	an array
	 */
	public function index()
	{
		// Title and breadcrump
		$data = [
			'title' => 'Permission',
			'breadcrumb' => [
				'permission' => 'user/permission'
			],
		];
		
		return view('agungsugiarto\boilerplate\Views\Permission\index', $data);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return array	an array
	 */
	public function show()
	{
		if ($this->request->isAJAX()) {	
        	return $this->response->setJSON([
				'success'  => true,
				'messages' => 'Success get data',
        	    'data' => $this->authorize->permissions()
        	]);
		}
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return array	an array
	 */
	public function create()
	{
		$validationRules = [
			'name'        => 'required|min_length[5]|max_length[255]|is_unique[auth_groups.name]',
			'description' => 'required|max_length[255]',
		];
		
		$name = $this->request->getPost('name');
		$description =  $this->request->getPost('description');

		if (!$this->validate($validationRules)) {
			return $this->response->setJSON([
				'success'  => false,
				'messages' => $this->validator->getErrors(),
			]);
		}

		return $this->response->setJSON([
			'success' => true,
			'messages' => 'Succes create',
			'data'    => $this->authorize->createPermission(url_title($name), $description),
		]);
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @param int		id
	 * @return array	an array
	 */
	public function edit($id = null)
	{
		return $this->response->setJSON([
			'success'  => true,
			'messages' => 'Success get data',
			'data'     => $this->authorize->permission($id),
		]);
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @param int 		id
	 * @return array	an array
	 */
	public function update($id = null)
	{
		$validationRules = [
			'name'        => 'required|max_length[255]|is_unique[auth_groups.name]',
			'description' => 'required|max_length[255]',
		];

		$data = $this->request->getRawInput();

		if (!$this->validate($validationRules)) {
			return $this->response->setJSON([
				'success'  => false,
				'messages' => $this->validator->getErrors(),
			]);
		}

		return $this->response->setJSON([
			'success'  => true,
			'messages' => 'Success update',
			'data'	   => $this->authorize->updatePermission($id, $data['name'], $data['description']),
		]);
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return array	an array
	 */
	public function delete($id = null)
	{
		if (!$this->authorize->deletePermission($id)) {
			return $this->response->setJSON([
				'success'  => false,
				'messages' => 'Unable delete',
			]);
		}

		return $this->response->setJSON([
			'success'  => true,
			'messages' => 'Success delete',
		]);
	}

	/**
	 * Validation Rules
	 *
	 * @return array	an array
	 */
	private function validationRules()
	{
		return [
			'name'        => 'required|max_length[255]|is_unique[auth_permissions.name',
			'description' => 'required|max_length[255]',
		];
	}
}