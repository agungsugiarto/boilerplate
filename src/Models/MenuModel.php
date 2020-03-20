<?php

namespace agungsugiarto\boilerplate\Models;

use agungsugiarto\boilerplate\Entities\MenuEntity;
use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';

    protected $returnType = MenuEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['parent_id', 'active', 'title', 'icon', 'route', 'sequence'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

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
}
