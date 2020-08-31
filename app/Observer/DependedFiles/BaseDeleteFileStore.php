<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 21.12.2019
 * Time: 21:39
 */

namespace App\Observer\DependedFiles;

use Illuminate\Filesystem\Filesystem;

abstract class BaseDeleteFileStore
{
    private $fs;

    private $files = [];

    private $deleteQueue = [];

    public function __construct()
    {
        $this->fs = new Filesystem();
    }

    public function softDeleteFiles() : bool
    {
        $files = $this->files;

        while ($file = array_pop($files)) {
            $tmp = tempnam(sys_get_temp_dir(), 'rm');
            $this->deleteQueue[$tmp] = $file;

            if (
                !$this->fs->copy($file, $tmp)
                || !$this->fs->delete($file)
            ) {
                return false;
            }
        }

        return true;
    }

    public function restoreDeletedFiles()
    {
        foreach ($this->deleteQueue as $tmp => &$real) {
            @$this->fs->move($tmp, $real);
            unset($real);
        }
    }

    public function dropQueueFiles()
    {
        foreach ($this->deleteQueue as $tmp => &$real) {
            @$this->fs->delete($tmp);
            unset($real);
        }
    }

    /**
     * @return array
     */
    public function getFiles() : array
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles(?array $files) : void
    {
        $this->files = $files;
    }

    /**
     * @param string $filePath
     */
    public function addFile(string $filePath) : void
    {
        $this->files[] = $filePath;
    }

    public function clearFiles() : void
    {
        $this->files = [];
    }
}