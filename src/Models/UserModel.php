<?php

namespace agungsugiarto\boilerplate\Models;

use CodeIgniter\Database\BaseBuilder;
use Myth\Auth\Models\UserModel as BaseModel;

class UserModel extends BaseModel
{
    public const ORDERABLE = [
        1 => 'first_name',
        2 => 'last_name',
        3 => 'username',
        4 => 'email',
        5 => 'created_at',
    ];

    /**
     * Get resource data.
     */
    public function getResource(string $search = ''): BaseBuilder
    {
        $builder = $this->builder()
            ->select('id, first_name, last_name, username, email, active, created_at');

        $condition = empty($search)
            ? $builder
            : $builder->groupStart()
                ->like('first_name', $search)
                ->orLike('last_name', $search)
                ->orLike('username', $search)
                ->orLike('email', $search)
                ->groupEnd();

        return $condition->where('deleted_at', null);
    }
}
