<?php

use agungsugiarto\boilerplate\Models\GroupMenuModel;
use agungsugiarto\boilerplate\Models\MenuModel;
use Config\Database;

if (! function_exists('menu')) {
    /**
     * Helpers for build menu.
     */
    function menu(): array
    {
        /**
         * Function parse.
         *
         * @param array $item
         * @param int   $parent_id
         *
         * @return array
         */
        $parse = static function (array $item, int $parent_id) use (&$parse) {
            $data = [];

            foreach ($item as $value) {
                if ($value->parent_id === $parent_id) {
                    $child           = $parse($item, $value->id);
                    $value->children = $child ?: '';
                    $data[]          = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        };

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->where('active', 1)->orderBy('sequence', 'asc')->get()->getResultObject(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        return $parse((new GroupMenuModel())->menuHasRole(), 0);
    }
}

if (! function_exists('nestable')) {
    /**
     * Helpers for build menu.
     */
    function nestable(): array
    {
        /**
         * Function parse.
         *
         * @param array $item
         * @param int   $parent_id
         *
         * @return array
         */
        $nest = static function (array $item, int $parent_id) use (&$nest) {
            $data = [];

            foreach ($item as $value) {
                if ($value->parent_id === $parent_id) {
                    $child           = $nest($item, $value->id);
                    $value->children = $child ?: '';
                    $data[]          = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        };

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->orderBy('sequence', 'asc')->findAll(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        $db      = Database::connect();
        $builder = $db->table('Menu');
        $builder->orderBy('sequence', 'asc');
        $query = $builder->get();

        return $nest($query->getResultObject(), 0);
    }
}

/**
 * The ugly for generate some html.
 *
 * return string hrml
 */
if (! function_exists('build')) {
    function build(): string
    {
        $html = '';

        foreach (menu() as $parent) {
            $open   = current_url() === base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route'), true) ? 'menu-open' : '';
            $active = current_url() === base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route'), true) ? 'active' : '';
            $link   = base_url($parent->route);

            $html .= "<li class='nav-item has-treeview {$open}'>";
            $html .= "<a href='{$link}' class='nav-link {$active}'>";
            $html .= "<i class='nav-icon {$parent->icon}'></i>";
            $html .= '<p>';
            $html .= $parent->title;
            if (count($parent->children)) {
                $html .= "<i class='right fas fa-angle-left'></i>";
            }
            $html .= '</p>';
            $html .= '</a>';
            if (count($parent->children)) {
                $html .= "<ul class='nav nav-treeview'>";

                foreach ($parent->children as $child) {
                    $link_child   = base_url($child->route);
                    $active_child = current_url() === base_url($child->route) ? 'active' : '';
                    $html .= "<li class='nav-item has-treeview'>";
                    $html .= "<a href='{$link_child}'";
                    $html .= "class='nav-link {$active_child}'>";
                    $html .= "<i class='nav-icon {$child->icon}'></i>";
                    $html .= "<p>{$child->title}</p>";
                    $html .= '</a>';
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }

        return $html;
    }
}
