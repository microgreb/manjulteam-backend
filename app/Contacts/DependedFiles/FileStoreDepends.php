<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 21.12.2019
 * Time: 14:44
 */

namespace App\Contacts\DependedFiles;

interface FileStoreDepends extends FileStore
{
    public function getFullFilePath() : string;
}