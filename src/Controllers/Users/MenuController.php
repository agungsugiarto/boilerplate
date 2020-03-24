<?php

namespace agungsugiarto\boilerplate\Controllers\Users;

use agungsugiarto\boilerplate\Controllers\BaseController;
use agungsugiarto\boilerplate\Entities\MenuEntity;
use agungsugiarto\boilerplate\Models\GroupMenuModel;
use agungsugiarto\boilerplate\Models\MenuModel;
use CodeIgniter\API\ResponseTrait;

/**
 * Class MenuController
 * @package agungsugiarto\boilerplate\Controllers\Users
 */
class MenuController extends BaseController
{
    use ResponseTrait;

    protected $menu;
    protected $groupsMenu;

    public function __construct()
    {
        $this->menu = new MenuModel();
        $this->groupsMenu = new GroupMenuModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return \CodeIgniter\View\View | \CodeIgniter\API\ResponseTrait
     */
    public function index()
    {
        $data = [
            'title' => 'Menu',
            'roles' => $this->authorize->groups(),
            'menus' => $this->menu->orderBy('sequence', 'asc')->findAll(),
        ];

        if ($this->request->isAJAX()) {
            return $this->respond([
                'success'  => true,
                'messages' => 'success get data',
                'data'     => nestable(),
            ]);
        }

        return view('agungsugiarto\boilerplate\Views\Menu\index', $data);
    }

    public function new()
    {
    }

    public function show($id)
    {
    }

    public function create()
    {
        $validationRules = [
            'parent_id'   => 'required|numeric',
            'active'      => 'required|numeric',
            'icon'        => 'required|min_length[5]|max_length[55]',
            'route'       => 'required|min_length[2]|max_length[255]',
            'title'       => 'required|min_length[2]|max_length[255]',
            'groups_menu' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        try {
            $this->db->transBegin();

            $menu = new MenuEntity();
            $menu->parent_id = $this->request->getPost('parent_id');
            $menu->active = $this->request->getPost('active');
            $menu->title = $this->request->getPost('title');
            $menu->icon = $this->request->getPost('icon');
            $menu->route = $this->request->getPost('route');
            $menu->sequence = $menu->sequence() + 1;

            $id = $this->menu->insert($menu);

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

    public function update($id)
    {
        $validationRules = [
            'parent_id'   => 'required|numeric',
            'active'      => 'required|numeric',
            'icon'        => 'required|min_length[5]|max_length[55]',
            'route'       => 'required|min_length[2]|max_length[255]',
            'title'       => 'required|min_length[2]|max_length[255]',
            'groups_menu' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = $this->request->getRawInput();

        try {
            $this->db->transBegin();

            $this->menu->update($id, [
                'parent_id' => $data['parent_id'],
                'active'    => $data['active'],
                'title'     => $data['title'],
                'icon'      => $data['icon'],
                'route'     => $data['route'],
            ]);

            // first remove all groups_menu by id
            $this->db->table('groups_menu')->where('menu_id', $id)->delete();

            foreach ($data['groups_menu'] as $groups) {
                // insert with new
                $this->groupsMenu->insert([
                    'group_id' => $groups,
                    'menu_id'  => $id,
                ]);
            }
        } catch (\Exception $e) {
            $this->db->transRollback();

            return $this->fail($e->getMessage());
        }

        $this->db->transCommit();

        return $this->respondCreated();
    }

    public function edit($id)
    {
        $found = $this->menu->getMenuById($id);

        if ($this->request->isAJAX()) {
            if (!$found) {
                return $this->fail('failed');
            }

            return $this->respond([
                'data'  => $found,
                'menu'  => $this->menu->getMenu(),
                'roles' => $this->menu->getRole(),
            ]);
        }
    }

    public function delete($id)
    {
        if (!$this->menu->where('id', $id)->delete()) {
            return $this->fail('fail deleted');
        }

        return $this->respondDeleted('success');
    }
}
