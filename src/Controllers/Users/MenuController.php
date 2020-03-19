<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;

class MenuController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Menu',
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success'  => true,
                'messages' => 'success get data',
                'data'     => nestable(),
            ]);
        }

        return view('agungsugiarto\boilerplate\Views\Menu\index', $data);
    }
}
