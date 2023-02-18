<?php

namespace agungsugiarto\boilerplate\Models;

use CodeIgniter\Database\BaseBuilder;
use Myth\Auth\Models\UserModel as BaseModel;

class UserModel extends BaseModel
{
    public const ORDERABLE = [
        1 => 'name',
        2 => 'username',
        3 => 'email',
        5 => 'created_at',
    ];

    protected $allowedFields = [
        'first_name', 'last_name',
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
    ];
    protected $validationRules = [
        'first_name'    => 'required',
        'last_name'     => 'required',
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];

    /**
     * Get resource data.
     */
    public function getResource(string $search = ''): BaseBuilder
    {
        $builder = $this->builder()
            ->select('id, CONCAT(first_name, " ", last_name) AS name, username, email, active, created_at');

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
