<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 21.12.2019
 * Time: 14:20
 */

namespace App\Contacts\DependedFiles;

use Illuminate\Database\Eloquent\Relations\Relation;

interface FileStoreBelongsDependence extends FileStore
{
    public function dependencyRelation() : Relation;
}