<?php

namespace agungsugiarto\boilerplate\Entities;

class Collection
{
    /**
     * Return data to colection map datatable.
     */
    public static function datatable(array $data, int $recordsTotal, int $recordsFiltered): array
    {
        return [
            'draw'            => service('request')->getGet('draw'),
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ];
    }
}
