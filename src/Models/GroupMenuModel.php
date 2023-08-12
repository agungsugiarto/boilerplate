<?php

namespace julio101290\boilerplate\Models;

use CodeIgniter\Model;

/**
 * Class GroupMenuModel.
 */
class GroupMenuModel extends Model
{
    protected $table = 'groups_menu';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['group_id', 'menu_id'];
    protected $skipValidation = true;

    /**
     * Menu has role to check specific user can
     * see accsess to the menu.
     *
     * @return array
     */
    public function menuHasRole()
    {
        // We need cache this menu ?
        if (!$found = cache(user()->id.'_group_menu')) {
            $found = $this->db->table('menu')
                ->select('menu.id, menu.parent_id, menu.active, menu.title, menu.icon, menu.route')
                ->join('groups_menu', 'menu.id = groups_menu.menu_id', 'left')
                ->join('auth_groups', 'groups_menu.group_id = auth_groups.id', 'left')
                ->join('auth_groups_users', 'auth_groups.id = auth_groups_users.group_id', 'left')
                ->join('users', 'auth_groups_users.user_id = users.id', 'left')
                ->where(['users.id' => user()->id, 'menu.active' => 1])
                ->orderBy('menu.sequence', 'asc')
                ->groupBy('menu.id')
                ->get()
                ->getResultObject();

            cache()->save(user()->id.'_group_menu', $found, 300);
        }

        return $found;
    }
}
