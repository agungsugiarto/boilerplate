<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel as BaseModel;

class UserModel extends BaseModel
{
    /**
     * FInd with paginate data.
     *
     * @param int    $length
     * @param int    $start
     * @param string $order
     * @param string $dir
     * @param string $keyword
     *
     * @return array
     */
    public function findPaginatedData(string $order, string $dir, int $length, int $start, string $keyword = ''): array
    {
        $this->builder()
            ->select('id, username, email, active, created_at')
            ->groupStart()
                ->like('username', $keyword)
                ->orLike('email', $keyword)
            ->groupEnd()
            ->where('deleted_at', null)
            ->orderBy($order, $dir)
            ->limit($length, $start);

        $results = $this->asObject(User::class)->findAll();

        foreach ($results as $result) {
            $data[] = [
                'id'          => $result->id,
                'active'      => $result->active,
                'username'    => $result->username,
                'email'       => $result->email,
                'created_at'  => $result->created_at,
                'roles'       => $result->getRoles(),
                'permissions' => $result->getPermissions(),
            ];
        }

        return $data;
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
        return $this->builder()
            ->select('id, username, email, active, created_at')
            ->groupStart()
                ->like('username', $keyword)
                ->orLike('email', $keyword)
            ->groupEnd()
            ->where('deleted_at', null)
            ->countAllResults();
    }
}
