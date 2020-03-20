<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;
use agungsugiarto\boilerplate\Entities\MenuEntity;
use agungsugiarto\boilerplate\Models\GroupMenuModel;
use agungsugiarto\boilerplate\Models\MenuModel;

class MenuController extends BaseController
{
    protected $menu;
    protected $groupsMenu;

    public function __construct()
    {
        $this->menu = new MenuModel();
        $this->groupsMenu = new GroupMenuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Menu',
            'roles' => $this->authorize->groups(),
            'menus' => $this->menu->orderBy('sequence', 'asc')->findAll(),
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

    public function create()
    {
        // dd($this->request->getPost());

        $validationRules = [
            'parent_id'   => 'required',
            'active'      => 'required',
            'icon'        => 'required',
            'route'       => 'required',
            'title'       => 'required',
            'groups_menu' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        try {
            $this->db->transBegin();

            $id = $this->menu->insert(new MenuEntity([
                'parent_id' => $this->request->getPost('parent_id'),
                'active'    => $this->request->getPost('active'),
                'title'     => $this->request->getPost('title'),
                'icon'      => $this->request->getPost('icon'),
                'route'     => $this->request->getPost('route'),
            ]));

            foreach ($this->request->getPost('groups_menu') as $groups) {
                $this->groupsMenu->insert([
                    'group_id' => $groups,
                    'menu_id'  => $id,
                ]);
            }

        } catch (\Exception $e) {
            $this->db->transRollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

        $this->db->transCommit();

        return redirect()->back()->with('message', lang('Auth.loginSuccess'));
    }
}
