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
use Illuminate\Filesystem\Filesystem;

class DeleteFilesDependedObserver extends BaseDeleteFileStore
{
    public function deleting(FileStoreDepends $model)
    {
        $this->clearFiles();

        $this->addFile($model->getFullFilePath());
    }

    public function deleted()
    {
        try {
            $this->softDeleteFiles();
        } catch (\Throwable $e) {
            $this->restoreDeletedFiles();

            throw $e;
        } finally {
            $this->dropQueueFiles();
        }
    }
}