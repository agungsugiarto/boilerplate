<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Authorization\GroupModel as BaseModel;

/**
 * Class Group.
 */
class GroupModel extends BaseModel
{
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

    /**
     * FInd with paginate data.
     *
     * @param int $length
     * @param int $start
     *
     * @return array
     */
    public function findPaginatedData(int $length, int $start, string $keyword = ''): ?array
    {
        if ($keyword) {
            $this->builder()
                 ->groupStart()
                     ->like('name', $keyword)
                     ->orLike('description', $keyword)
                 ->groupEnd();
        }

        return $this->builder()->limit($length, $start)->get()->getResultObject();
    }

    /**
     * FInd with count all data.
     *
     * @param string $keyword
     *
     * @return int
     */
    public function countFindData(string $keyword = ''): int
    {
        return $keyword ? $this->builder()
                           ->groupStart()
                                ->like('name', $keyword)
                                ->orLike('description', $keyword)
                           ->groupEnd()
                           ->countAllResults()

                        : $this->builder()->countAllResults();
    }
}
