<?php

namespace agungsugiarto\boilerplate\Controllers;

use CodeIgniter\Controller;

class TestController extends Controller
{
    public function index()
    {        
        return view('agungsugiarto\boilerplate\Views\Role\index');
    }
}