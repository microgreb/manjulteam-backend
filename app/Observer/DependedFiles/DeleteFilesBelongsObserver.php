<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 21.12.2019
 * Time: 14:18
 */

namespace App\Observer\DependedFiles;

use App\Contacts\DependedFiles\FileStoreBelongsDependence;
use App\Contacts\DependedFiles\FileStoreDepends;

class DeleteFilesBelongsObserver extends BaseDeleteFileStore
{
    public function deleting(FileStoreBelongsDependence $model)
    {
        $this->clearFiles();
        \DB::beginTransaction();

        try {
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

    public function deleted()
    {
        try {
            $this->softDeleteFiles();
        } catch (\Throwable $e) {
            $this->restoreDeletedFiles();

            \DB::rollBack();
            throw $e;
        } finally {
            $this->dropQueueFiles();
        }

        \DB::commit();
    }
}