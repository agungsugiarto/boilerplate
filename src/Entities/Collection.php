<?php

namespace julio101290\boilerplate\Entities;

class Collection
{
    /**
     * Return data to colection map datatable.
     *
     * @param array $data
     * @param int   $recordsTotal
     * @param int   $recordsFiltered
     *
     * @return array
     */
    public static function datatable(array $data, int $recordsTotal, int $recordsFiltered)
    {
        return [
            'draw'            => service('request')->getGet('draw'),
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ];
    }
}
