<?php

namespace agungsugiarto\boilerplate\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Config\Services;

class BaseController extends Controller
{
    /**
	 * @var Authorize 
	 */
    protected $authorize;
    /**
	 * @var Auth
	 */
    protected $auth;

	/**
	 * @var Config
	 */
	protected $config;

	/**
	 * @var Db
	 */
	protected $db;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['auth', 'inflector', 'form', 'menu'];

	/**
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * @var \Config\Services::validation();
	 */
	protected $validation;
	
	
    /**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
        $this->session = Services::session();
        $this->auth = Services::authentication();
		$this->authorize = Services::authorization(); 
		$this->validation = Services::validation();
		$this->db = \Config\Database::connect();
	}
}