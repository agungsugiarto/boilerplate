<?php

namespace agungsugiarto\boilerplate\Models;

use CodeIgniter\Database\BaseBuilder;
use Myth\Auth\Models\PermissionModel as BaseModel;

class PermissionModel extends BaseModel
{
    public const ORDERABLE = [
        1 => 'name',
        2 => 'description',
    ];

    /**
     * Get resource data.
     */
    public function getResource(string $search = ''): BaseBuilder
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
