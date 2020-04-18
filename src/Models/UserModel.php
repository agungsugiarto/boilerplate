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
     * 
     * @return array
     */
    public function findPaginatedData(int $length, int $start, string $keyword = ''): ?array
	{
		if ($keyword) {
			$this->builder()
				 ->groupStart()
					 ->like('username', $keyword)
                     ->orLike('email', $keyword)
                 ->groupEnd();
		}

		return $this->builder()->where('deleted_at', null)->limit($length, $start)->get()->getResultObject();
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
                                ->like('username', $keyword)
                                ->orLike('email', $keyword)
                           ->groupEnd()
                           ->where('deleted_at', null)
                           ->countAllResults()
                           
                        : $this->builder()->where('deleted_at', null)->countAllResults();
    }
}