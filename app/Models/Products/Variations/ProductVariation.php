<?php

    namespace App\Models\Products\Variations;

    use App\Models\Products\Sizes\Size;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class ProductVariation
     *
     * @package App\Models\Products\Variations
     */
    class ProductVariation extends Model
    {

        /**
         * @var array
         */
        protected $fillable = [
            'product_id', 'size_id', 'quantity'
        ];

        /**
         * @var array
         */
        protected $appends = [
            'size_name'
        ];

        /**
         * @var array
         */
        protected $attributes = [

        ];

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function size()
        {
            return $this->belongsTo(Size::class);
        }


        /**
         *
         */
        public function getSizeNameAttribute()
        {
            return $this->size->name;
        }
    }
