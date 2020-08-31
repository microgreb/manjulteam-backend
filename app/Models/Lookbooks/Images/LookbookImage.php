<?php

    namespace App\Models\Lookbooks\Images;

    use App\Contacts\DependedFiles\FileStoreDepends;
    use App\Observer\DependedFiles\DeleteFilesBelongsObserver;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    class LookbookImage extends Model implements FileStoreDepends
    {

        /**
         * @var array
         */
        protected $fillable = [
            'name', 'path', 'image_type_id'
        ];

        /**
         * @var array
         */
        protected $appends = ['url'];

        /**
         * @var array
         */
        protected $attributes = [];

        protected static function boot()
        {
            parent::boot(); // TODO: Change the autogenerated stub

            self::observe(DeleteFilesBelongsObserver::class);
        }

        /**
         * @return \Illuminate\Contracts\Routing\UrlGenerator|string
         */
        public function getUrlAttribute()
        {
            return url(Storage::url($this->path));
        }

        public function getFullFilePath() : string
        {
            return storage_path($this->path);
        }

        public function hasPersonalFolder() : bool
        {
            return false;
        }
    }
