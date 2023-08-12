<?php

namespace julio101290\boilerplate\Models;

use Myth\Auth\Authorization\PermissionModel as BaseModel;

class PermissionModel extends BaseModel
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
}
