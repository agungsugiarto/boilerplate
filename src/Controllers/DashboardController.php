<?php

namespace agungsugiarto\boilerplate\Controllers;

/**
 * Class DashboardController
 * @package agungsugiarto\boilerplate\Controllers
 */
class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        return view('agungsugiarto\boilerplate\Views\dashboard', $data);
    }
}
