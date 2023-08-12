<?php

namespace julio101290\boilerplate\Models;

use Myth\Auth\Models\UserModel as BaseModel;

class UserModel extends BaseModel {

    protected $allowedFields = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
        'firstname', 'lastname'
    ];
    
    
    const ORDERABLE = [
        1 => 'username',
        2 => 'firstname',
        3 => 'lastname',
        4 => 'email',
        6 => 'created_at',
    ];

    /**
     * Get resource data.
     *
     * @param string $search
     *
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getResource(string $search = '') {
        $builder = $this->builder()
                ->select('id, username, email, active,firstname,lastname, created_at');

        $condition = empty($search) ? $builder : $builder->groupStart()
                        ->like('username', $search)
                        ->orLike('email', $search)
                         ->orLike('firstname', $search)
                         ->orLike('lastname', $search)
                        ->groupEnd();

        return $condition->where('deleted_at', null);
    }

}
