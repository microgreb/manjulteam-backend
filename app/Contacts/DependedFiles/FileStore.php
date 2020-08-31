<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 21.12.2019
 * Time: 14:55
 */

namespace App\Contacts\DependedFiles;

interface FileStore {

    public function hasPersonalFolder() : bool;

}