<?php

if (!function_exists('starts_with')) {
    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string       $haystack Haystack to find in.
     * @param string|array $needles  Needle to search from haystack.
     *
     * @return bool
     */
    function starts_with($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('str_after')) {
    /**
     * Return the remainder of a string after a given value.
     *
     * @param string $subject Subject to search from.
     * @param string $search  Search string from subject.
     *
     * @return string
     */
    function str_after($subject, $search)
    {
        return $search === '' ? $subject : array_reverse(explode($search, $subject, 2))[0];
    }
}

if (!function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path              Path of the asset file.
     * @param string $manifestDirectory Custom manifest directory.
     *
     * @throws \Exception
     *
     * @return string
     */
    function mix($path, $manifestDirectory = '')
    {
        /**
         * Mix manifests.
         *
         * @var array
         */
        static $manifests = [];

        if (!starts_with($path, '/')) {
            $path = "/{$path}";
        }

        if ($manifestDirectory && !starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (file_exists(ROOTPATH.$manifestDirectory.'/hot')) {
            $url = rtrim(file_get_contents(ROOTPATH.$manifestDirectory.'/hot'));
            if (starts_with($url, ['http://', 'https://'])) {
                return str_after($url, ':').$path;
            }

            return "//localhost:8080{$path}";
        }

        $manifestPath = ROOTPATH.$manifestDirectory.'/mix-manifest.json';
        if (!isset($manifests[$manifestPath])) {
            if (!file_exists($manifestPath)) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];
        if (!isset($manifest[$path])) {
            throw new Exception("Unable to locate AssetMix file: {$path}.");
        }

        return 'assets'.$manifest[$path];
    }
}
