<?php

namespace agungsugiarto\boilerplate\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'icon', 'route'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'title' => 'required|min_length[10]|max_length[60]',
        'icon'  => 'required',
        'route' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
