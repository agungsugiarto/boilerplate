<?php

namespace agungsugiarto\boilerplate\Models;

use Myth\Auth\Authorization\PermissionModel as BaseModel;

class PermissionModel extends BaseModel
{
    /**
     * FInd with paginate data.
     *
     * @param int $length
     * @param int $start
     *
     * @return array
     */
    public function findPaginatedData(int $length, int $start, string $keyword = ''): ?array
    {
        if ($keyword) {
            $this->builder()
                 ->groupStart()
                     ->like('name', $keyword)
                     ->orLike('description', $keyword)
                 ->groupEnd();
        }

        return $this->builder()->limit($length, $start)->get()->getResultObject();
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
        return $keyword ? $this->builder()
                           ->groupStart()
                                ->like('name', $keyword)
                                ->orLike('description', $keyword)
                           ->groupEnd()
                           ->countAllResults()
                           
                        : $this->builder()->countAllResults();
    }
}
