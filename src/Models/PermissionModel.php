<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Authorization\PermissionModel as BaseModel;

class PermissionModel extends BaseModel
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
        return $this->builder()
            ->select('id, name, description')
            ->groupStart()
                ->like('name', $keyword)
                ->orLike('description', $keyword)
            ->groupEnd()
            ->orderBy($order, $dir)
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
            ->select('id, name, description')
            ->groupStart()
                ->like('name', $keyword)
                ->orLike('description', $keyword)
            ->groupEnd()
            ->countAllResults();
    }
}
