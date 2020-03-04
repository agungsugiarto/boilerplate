<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Authorization\GroupModel;

class Group extends GroupModel
{
    public function getPermissionsForGroup(int $groupId)
    {
        return $this->db->table('auth_groups')
            ->select('*')
            ->join('auth_groups_permissions', 'auth_groups_permissions.group_id = auth_groups.id', 'inner')
            ->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id', 'inner')
            ->where('auth_groups.id', $groupId)
            ->get()
            ->getResultArray();
    }
}
