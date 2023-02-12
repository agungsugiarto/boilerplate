<?php

namespace agungsugiarto\boilerplate\Controllers;

use Myth\Auth\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Myth\Auth\Authentication\LocalAuthenticator;
use Myth\Auth\Authorization\FlatAuthorization;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController.
 */
class BaseController extends Controller
{
    /**
     * @var FlatAuthorization
     */
    protected FlatAuthorization $authorize;

    /**
     * @var LocalAuthenticator
     */
    protected LocalAuthenticator $auth;

    /**
     * @var BaseConnection|BaseBuilder
     */
    protected $db;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth', 'form', 'menu'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        $this->auth = Services::authentication();
        $this->authorize = Services::authorization();
        $this->db = Database::connect();
    }
}
