<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;
use agungsugiarto\boilerplate\Models\MenuModel;

class MenuController extends BaseController
{
    protected $menu;

    public function __construct()
    {
        $this->menu = new MenuModel();
    }

    public function index()
    {
        return $this->response->setJSON(
            $this->parse($this->menu->withDeleted()->findAll(), 0)
        );
    }

    private function parse($item, $parent_id)
    {
        $data = [];
        foreach ($item as $value) {
            if ($value['parent_id'] == $parent_id) {
                $child = $this->parse($item, $value['id']);
                $value['child'] = $child ?: $child;
                $data[] = $value;
            }
        }

        return $data;
    }
}
