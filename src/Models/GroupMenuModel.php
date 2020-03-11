<?php

namespace agungsugiarto\boilerplate\Models;

use CodeIgniter\Model;

class GroupMenuModel extends Model
{
    protected $table = 'groups_menu';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['group_id', 'menu_id'];
    protected $skipValidation = true;
}
