<?php

    namespace App\Models\Products\Sizes;

    use App\Models\Products\Variations\ProductVariation;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Size
     *
     * @package App\Models\Products\Sizes
     */
    class Size extends Model
    {

        /**
         * @var array
         */
        protected $fillable = [];

        /**
         * @var array
         */
        protected $appends = [];

        /**
         * @var array
         */
        protected $attributes = [];


        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function product_variations()
        {
            return $this->hasMany(ProductVariation::class);
        }

        /**
         */
        public function specific_product_variation()
        {
            return $this->hasOne(ProductVariation::class);
        }
    }
