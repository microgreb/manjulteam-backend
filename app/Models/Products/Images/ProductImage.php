<?php

    namespace App\Models\Products\Images;

    use App\Contacts\DependedFiles\FileStoreDepends;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;


    class ProductImage extends Model implements FileStoreDepends
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
        protected $appends = ['url', 'url_medium'];

        /**
         * @var array
         */
        protected $attributes = [];

        /**
         * @return \Illuminate\Contracts\Routing\UrlGenerator|string
         */
        public function getUrlAttribute()
        {
            return url(Storage::url($this->path));
        }

        public function getUrlMediumAttribute()
        {
            $url_parts = explode('/', $this->path );
            $url_parts[count($url_parts) - 1] = preg_replace('/(.*?\_)/', '$1medium_', end($url_parts));
            $medium_image = implode('/', $url_parts);
            if( !Storage::exists( $medium_image ) ) {
                $medium_image = $this->path;
            }
            return url(Storage::url( $medium_image ));
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
