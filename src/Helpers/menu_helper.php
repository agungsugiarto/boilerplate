<?php

use julio101290\boilerplate\Models\GroupMenuModel;
use julio101290\boilerplate\Models\MenuModel;

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

/**
 * The ugly for generate some html.
 *
 * return string hrml
 */
if (!function_exists('build')) {
    function build()
    {
        $html = '';
        foreach (menu() as $parent) {
            $open = current_url() == base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route')) ? 'menu-open' : '';
            $active = current_url() == base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route')) ? 'active' : '';
            $link = base_url($parent->route);

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
                    $link_child = base_url($child->route);
                    $active_child = current_url() == base_url($child->route) ? 'active' : '';
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
