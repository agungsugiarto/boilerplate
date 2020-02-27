<?php

use agungsugiarto\boilerplate\Models\MenuModel;

if (!function_exists('menu')) {
    /**
     * Helpers for build menu.
     *
     * @return array
     */
    function menu()
    {
        function parse($item, $parent_id)
        {
            $data = [];
            foreach ($item as $value) {
                if ($value['parent_id'] == $parent_id) {
                    $child = parse($item, $value['id']);
                    $value['child'] = $child ?: $child;
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
        return parse((new MenuModel())->orderBy('sequence', 'asc')->findAll(), 0);
    }
}
