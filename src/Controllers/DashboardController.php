<?php

namespace julio101290\boilerplate\Controllers;

/**
 * Class DashboardController.
 */
class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        return view('julio101290\boilerplate\Views\dashboard', $data);
    }
}
