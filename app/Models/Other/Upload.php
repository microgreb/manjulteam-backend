<?php

    namespace App\Models\Other;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    /**
     * Class Upload
     *
     * @package App\Models\Other
     */
    class Upload extends Model
    {

        /**
         * @var array
         */
        protected $fillable = ['original_name', 'file_name', 'path'];

        /**
         * @param $value
         * @return string
         */
        public function getPathAttribute($value)
        {
            return $value . '/';
        }

        /**
         * Clear All Uploads & Directory
         */
        public static function clear()
        {
            Storage::deleteDirectory('public/images/uploads');

            Upload::truncate();
        }
    }
