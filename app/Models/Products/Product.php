<?php

    namespace App\Models\Products;

    use App\Contacts\DependedFiles\FileStoreBelongsDependence;
    use App\Models\Orders\Order;
    use App\Models\Products\Images\ProductImage;
    use App\Models\Products\Sizes\Size;
    use App\Models\Products\Variations\ProductVariation;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\Relation;

    /**
     * Class Product
     *
     * @package App\Models\Products
     */
    class Product extends Model implements FileStoreBelongsDependence
    {
        /**
         * @var array
         */
        protected $fillable = [
            'name', 'code', 'gender', 'price', 'description', 'featured'
        ];

        /**
         * @var array
         */
        protected $appends = ['stock_total_quantity', 'thumbnail', 'upload_directory', 'category_name'];

        /**
         * @var array
         */
        protected $with = ['variations', 'main_image', 'hover_image', 'additional_images', 'sizes'];

        protected $casts = [
            'featured' => 'boolean'
        ];

        /**
         * Get a new query builder for the model's table.
         *
         * @param bool $ordered
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public function newQuery($ordered = true)
        {
            $query = parent::newQuery();

            if (empty($ordered)) {
                return $query;
            }

            return $query
                ->orderBy('featured', 'DESC')
                ->orderBy('created_at', 'DESC');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function images()
        {
            return $this->hasMany(ProductImage::class);
        }

        /**
         * @return mixed
         */
        public function additional_images()
        {
            return $this->hasMany(ProductImage::class)->whereImageTypeId(3);
        }

        /**
         * @return mixed
         */
        public function main_image()
        {
            return $this->hasOne(ProductImage::class)->whereImageTypeId(1);
        }

        /**
         * @return mixed
         */
        public function hover_image()
        {
            return $this->hasOne(ProductImage::class)->whereImageTypeId(2);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function variations()
        {
            return $this->hasMany(ProductVariation::class)->where('quantity', '>', 0);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function sizes()
        {
            return $this->belongsToMany(Size::class, 'product_variations');
        }

        public function orders()
        {
            return $this->belongsToMany(Order::class,'order_products');
        }


        /**
         * Total Storage Items Quantity Computed
         *
         * @return mixed
         */
        public function getStockTotalQuantityAttribute()
        {
            return $this->variations()->sum('quantity');
        }

        /**
         * Thumbnail Preview Computed
         *
         * @return string
         */
        public function getThumbnailAttribute()
        {
            // change ../unixtime_name.jpg to ../unixtime_thumb_name.jpg
            $full_image = $this->main_image->url;
            $url_parts = explode('/', $full_image);
            $url_parts[count($url_parts) - 1] = preg_replace('/(.*?\_)/', '$1thumb_', end($url_parts));
            $thumb_image = implode('/', $url_parts);

            return $thumb_image;
        }

        /**
         * Upload Directory for Photos Computed
         *
         * @return string
         */
        public function getUploadDirectoryAttribute()
        {
            return 'public/images/products/' . $this->id * 98 . '/';
        }


        /**
         * Category Name Computed. Based on Gender.
         *
         * @return mixed
         */
        public function getCategoryNameAttribute()
        {
            $categories = [
                '1' => 'men',
                '2' => 'women',
                '3' => 'unisex',
            ];

            return $categories[$this->gender];
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
