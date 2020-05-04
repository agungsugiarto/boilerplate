<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Models\UserModel as BaseModel;

class UserModel extends BaseModel
{
    /**
     * FInd with paginate data.
     *
     * @param int $length
     * @param int $start
     * @param string $keyword
     *
     * @return array
     */
    public function findPaginatedData(int $length, int $start, string $keyword = ''): array
    {
        return $this->builder()
            ->select('id, username, email, active, created_at')
            ->groupStart()
                ->like('username', $keyword)
                ->orLike('email', $keyword)
            ->groupEnd()
            ->where('deleted_at', null)
            ->limit($length, $start)
            ->get()
            ->getResultObject();
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
