<?php

    namespace App\Models\Orders\Products;

    use App\Models\Orders\Order;
    use App\Models\Products\Product;
    use App\Models\Products\Sizes\Size;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class OrderProduct
     *
     * @package App\Models\Orders\Products
     */
    class OrderProduct extends Model
    {

        /**
         * @var array
         */
        protected $fillable = ['product_id', 'size_id', 'quantity', 'price'];

        /**
         * @var array
         */
        protected $appends = [];

        /**
         * @var array
         */
        protected $attributes = [];

        /**
         * @var array
         */
        protected $with = ['product', 'size'];

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function product()
        {
            return $this->belongsTo(Product::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function order()
        {
            return $this->belongsTo(Order::class, 'product_id');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function size()
        {
            return $this->belongsTo(Size::class);
        }
    }
