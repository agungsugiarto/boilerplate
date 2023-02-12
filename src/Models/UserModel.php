<?php

namespace agungsugiarto\boilerplate\Models;

use CodeIgniter\Database\BaseBuilder;
use Myth\Auth\Models\UserModel as BaseModel;

class UserModel extends BaseModel
{
    const ORDERABLE = [
        1 => 'username',
        2 => 'email',
        4 => 'created_at',
    ];

    /**
     * Get resource data.
     *
     * @param string $search
     *
     * @return BaseBuilder
     */
    public function getResource(string $search = ''): BaseBuilder
    {
        $builder = $this->builder()
            ->select('id, username, email, active, created_at');

        $condition = empty($search)
            ? $builder
            : $builder->groupStart()
                ->like('username', $search)
                ->orLike('email', $search)
            ->groupEnd();

        return $condition->where('deleted_at', null);
    }
}
