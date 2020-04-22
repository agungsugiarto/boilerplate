<?php

namespace agungsugiarto\boilerplate\Utility;

/**
 * Contract for fily utility class
 */
interface FileUtilityInterface
{
    /**
     * Copy files or directories to new location
     *
     * @param string $from Path of a file/directory
     * @param string $to Path of new location
     * @return bool
     */
    public function copy($from, $to);

    /**
     * Copy files and directories recursively.
     *
     * @param string $source Source path to copy from.
     * @param string $destination Destination path to copy to.
     * @return void
     */
    public function recursiveCopy($source, $destination);

    /**
     * Checks if give file or directory exists
     *
     * @param strin $path Location of a file/directory
     * @return bool
     */
    public function exists($path);

    /**
     * Create new directory
     *
     * @param string $path Location of a directory
     * @param array $options Configuration options
     * @return bool
     */
    public function mkdir($path, $options = []);

    /**
     * Remove(delete) files or directories
     *
     * @param string|array $paths Path of a file/directory to delete
     * @return void
     */
    public function delete($paths);
}
