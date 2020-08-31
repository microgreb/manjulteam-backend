<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 21.12.2019
 * Time: 14:18
 */

namespace App\Observer\DependedFiles;

use App\Contacts\DependedFiles\FileStore;
use App\Contacts\DependedFiles\FileStoreBelongsDependence;
use App\Contacts\DependedFiles\FileStoreDepends;
use App\Models\Products\Product;
use Illuminate\Filesystem\Filesystem;

class DeleteFilesProductObserver extends DeleteFilesBelongsObserver
{
    public function deleting(FileStoreBelongsDependence $model)
    {
        $this->clearFiles();
        \DB::beginTransaction();

        try {
            /* @var $model Product */
            $model->variations()->delete();

            $model
                ->dependencyRelation()
                ->get()
                ->each(function(FileStoreDepends $fileStore) {
                    $this->addFile($fileStore->getFullFilePath());
                    $fileStore->delete();
                });
        } catch (\Throwable $e) {

            \DB::rollBack();

            throw $e;
        }
    }
}