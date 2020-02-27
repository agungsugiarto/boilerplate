<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;

class UserController extends BaseController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return array	an array
	 */
	public function index()
	{
        return $this->response->setJSON([
            'groups' => $this->authorize->groups()
        ]);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return array	an array
	 */
	public function show($id = null)
	{
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return array	an array
	 */
	public function create()
	{
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return array	an array
	 */
	public function edit($id = null)
	{
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return array	an array
	 */
	public function update($id = null)
	{
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return array	an array
	 */
	public function delete($id = null)
	{
	}
}