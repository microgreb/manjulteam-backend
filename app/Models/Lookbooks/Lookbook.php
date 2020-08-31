<?php

    namespace App\Models\Lookbooks;

    use App\Contacts\DependedFiles\FileStoreBelongsDependence;
    use App\Models\Lookbooks\Images\LookbookImage;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\Relation;

    /**
     * Class Lookbook
     *
     * @package App\Models\Lookbooks
     */
    class Lookbook extends Model implements FileStoreBelongsDependence
    {

        /**
         * @var array
         */
        protected $fillable = ['name', 'image_type_id'];

        /**
         * @var array
         */
        protected $with = ['images', 'main_image', 'additional_images'];

        /**
         * @var array
         */
        protected $appends = ['upload_directory', 'thumbnail'];

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function images()
        {
            return $this->hasMany(LookbookImage::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function main_image()
        {
            return $this->hasOne(LookbookImage::class)->where('image_type_id', 1);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function additional_images()
        {
            return $this->hasMany(LookbookImage::class)->where('image_type_id', 3);
        }

        /**
         * Upload Directory for Photos Computed
         *
         * @return string
         */
        public function getUploadDirectoryAttribute()
        {
            return 'public/images/lookbooks/' . $this->id * 98 . '/';
        }

        /**
         * @return mixed
         */
        public function getThumbnailAttribute()
        {
            return $this->main_image->url;
        }

        public function dependencyRelation() : Relation
        {
            return $this->images();
        }

        public function hasPersonalFolder() : bool
        {
            return true;
        }
    }
