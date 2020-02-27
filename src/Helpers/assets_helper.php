<?php

if (!function_exists('assets')) {
    /**
     * Helpers for load assets.
     *
     * @param $file
     *
     * @return string
     */
    function assets(string $file): string
    {
        helper('filesystem');

        $path = substr($file, 0, strrpos($file, DIRECTORY_SEPARATOR));
        if (!empty($path)) {
            $file = substr($file, 0, strlen($path));
            $path .= '/';
        }

        $parts = explode('.', $file);

        $filename = array_shift($parts);

        $existing = get_filenames(ROOTPATH."public/assets/{$path}");

        $found = '';
        foreach ($existing as $exFile) {
            if (strrpos($exFile, $filename) === 0) {
                $found = $exFile;
                break;
            }
        }

        return $found !== ''
            ? "assets/{$found}"
            : '';
    }
}
