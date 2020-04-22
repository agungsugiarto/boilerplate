<?php

namespace agungsugiarto\boilerplate\Utility;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class that handles manipulation of files and directories.
 */
class FilteUtility implements FileUtilityInterface
{
    /**
     * {@inheritdoc}
     */
    public function copy($from, $to)
    {
        if (copy($from, $to)) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function recursiveCopy($source, $destination)
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $this->mkdir($destination.DS.$iterator->getSubPathName());
            } else {
                $this->copy($item, $destination.DS.$iterator->getSubPathName());
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * {@inheritdoc}
     */
    public function mkdir($path, $options = [])
    {
        if ($this->exists($path)) {
            return false;
        }

        return mkdir($path, 0755);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($paths)
    {
        if (!is_array($paths)) {
            $paths = [$paths];
        }

        foreach ($paths as $path) {
            if (!$this->exists($path)) {
                continue;
            }

            if (is_dir($path)) {
                $this->deleteDir($path);
            } else {
                unlink($path);
            }
        }
    }

    /**
     * Force delete non-empty directory.
     *
     * @param string $path Path of the directory to remove.
     *
     * @return void
     */
    private function deleteDir($path)
    {
        $it = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator(
            $it,
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }

        rmdir($path);
    }
}
