<?php

namespace agungsugiarto\boilerplate\Entities;

class Collection
{
    /**
     * Return data to colection map datatable.
     * 
     * @param array $data
     * 
     * @return array
     */
    public function toColection(array $data, int $recordsTotal, int $recordsFiltered)
    {
        return [
            'draw'            => service('request')->getGet('draw'),
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ];
    }
}