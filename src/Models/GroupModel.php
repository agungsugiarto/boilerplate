<?php

namespace julio101290\boilerplate\Models;

use Myth\Auth\Authorization\GroupModel as BaseModel;

/**
 * Class Group.
 */
class GroupModel extends BaseModel
{
    const ORDERABLE = [
        1 => 'name',
        2 => 'description',
    ];

    /**
     * Get resource data.
     *
     * @param string $search
     *
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getResource(string $search = '')
    {
        $builder = $this->builder()
            ->select('id, name, description');

        return empty($search)
            ? $builder
            : $builder->groupStart()
                ->like('name', $search)
                ->orLike('description', $search)
            ->groupEnd();
    }

    /**
     * Returns an array of all groups that a user is a member of.
     *
     * @param $userId
     *
     * @return object
     */
    public function getGroupsForUser(int $userId)
    {
        $group = $this->builder()
            ->join('auth_groups_users', 'auth_groups_users.group_id = auth_groups.id', 'left')
            ->where('user_id', $userId)
            ->get()
            ->getResultObject();

        $found = [];
        foreach ($group as $row) {
            $found[$row->id] = strtolower($row->name);
        }

        return $found;
    }
}
