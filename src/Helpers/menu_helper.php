<?php

use agungsugiarto\boilerplate\Models\GroupMenuModel;
use agungsugiarto\boilerplate\Models\MenuModel;

if (!function_exists('menu')) {
    /**
     * Helpers for build menu.
     *
     * @return array
     */
    function menu()
    {
        /**
         * Function parse.
         *
         * @param item       array
         * @param parent_id  int
         *
         * @return array
         */
        function parse($item, $parent_id)
        {
            $data = [];
            foreach ($item as $value) {
                if ($value->parent_id == $parent_id) {
                    $child = parse($item, $value->id);
                    $value->children = $child ?: $child;
                    $data[] = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        }

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->where('active', 1)->orderBy('sequence', 'asc')->get()->getResultObject(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        return parse((new GroupMenuModel())->menuHasRole(), 0);
    }
}

if (!function_exists('nestable')) {
    /**
     * Helpers for build menu.
     *
     * @return array
     */
    function nestable()
    {
        /**
         * Function parse.
         *
         * @param item       array
         * @param parent_id  int
         *
         * @return array
         */
        function nest($item, $parent_id)
        {
            $data = [];
            foreach ($item as $value) {
                if ($value->parent_id == $parent_id) {
                    $child = nest($item, $value->id);
                    $value->children = $child ? $child : '';
                    $data[] = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        }

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->orderBy('sequence', 'asc')->findAll(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        return nest((new MenuModel())->orderBy('sequence', 'asc')->get()->getResultObject(), 0);
    }
}
