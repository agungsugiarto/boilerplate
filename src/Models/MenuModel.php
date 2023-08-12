<?php

namespace julio101290\boilerplate\Models;

use julio101290\boilerplate\Entities\MenuEntity;
use CodeIgniter\Model;

/**
 * Class MenuModel.
 */
class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';

    protected $returnType = MenuEntity::class;

    protected $allowedFields = ['parent_id', 'active', 'title', 'icon', 'route', 'sequence'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // trigger
    protected $afterInsert = ['deleteCacheMenu'];
    protected $afterUpdate = ['deleteCacheMenu'];
    protected $afterDelete = ['deleteCacheMenu'];

    protected $validationRules = [
        'title'       => 'required|min_length[10]|max_length[60]',
        'parent_id'   => 'required',
        'active'      => 'required',
        'icon'        => 'required',
        'route'       => 'required',
        'groups_menu' => 'required',
    ];

    protected $validationMessages = [];
    protected $skipValidation = true;

    /**
     * Find menu. By default we need to detect driver,
     * because different function group_concat
     * between MySQLi and Postgres.
     *
     * @param int id
     *
     * @return array
     */
    public function getMenuById($id)
    {
        return $this->db->DBDriver === 'Postgre'
            ? $this->getMenuDRiverPostgre($id)
            : $this->getMenuDriverMySQLi($id);
    }

    /**
     * function getMenu for select2.
     *
     * @return array
     */
    public function getMenu()
    {
        return $this->db->table('menu')
            ->select('id, title as text')
            ->orderBy('sequence', 'asc')
            ->get()
            ->getResultArray();
    }

    /**
     * Function getRole for select2.
     *
     * @return array
     */
    public function getRole()
    {
        return $this->db->table('auth_groups')
            ->select('id, name as text')
            ->get()
            ->getResultArray();
    }

    /**
     * Function getMenuDriverMySQLi.
     *
     * @param int id
     *
     * @return array
     */
    private function getMenuDriverMySQLi($id)
    {
        return $this->db->table('menu')
            ->select("menu.id, menu.parent_id, menu.active, menu.title, menu.icon, menu.route, groups_menu.menu_id, group_concat(groups_menu.group_id SEPARATOR '|') as group_id")
            ->join('groups_menu', 'menu.id = groups_menu.menu_id', 'left')
            ->join('auth_groups', 'groups_menu.group_id = auth_groups.id', 'left')
            ->where('menu.id', $id)
            ->get()
            ->getRow();
    }

    /**
     * Function getMenuDRiverPostgre.
     *
     * @param int id
     *
     * @return array
     */
    private function getMenuDRiverPostgre($id)
    {
        return $this->db->table('menu')
            ->select("menu.id, menu.parent_id, menu.active, menu.title, menu.icon, menu.route, groups_menu.menu_id, array_to_string(array_agg(groups_menu.group_id),'|') as group_id")
            ->join('groups_menu', 'menu.id = groups_menu.menu_id', 'left')
            ->join('auth_groups', 'groups_menu.group_id = auth_groups.id', 'left')
            ->where('menu.id', $id)
            ->groupBy(['menu.id', 'groups_menu.menu_id'])
            ->get()
            ->getRow();
    }

    /**
     * deleteCacheMenu.
     *
     * @return void
     */
    protected function deleteCacheMenu()
    {
        if (cache(user()->id.'_group_menu')) {
            cache()->delete(user()->id.'_group_menu');
        }
    }
}
