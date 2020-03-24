<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Authorization\GroupModel;

/**
 * Class Group.
 */
class Group extends GroupModel
{
    /**
     * Gets all permissions for a group in a way that can be
     * easily used to check against:.
     *
     * @param int $groupId
     *
     * @return array
     */
    public function getPermissionsForGroup(int $groupId): array
    {
        return $this->db->table('auth_groups')
            ->select('auth_permissions.id, auth_permissions.name, auth_permissions.description')
            ->join('auth_groups_permissions', 'auth_groups_permissions.group_id = auth_groups.id', 'inner')
            ->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id', 'inner')
            ->where('auth_groups.id', $groupId)
            ->get()
            ->getResultArray();
    }
}
