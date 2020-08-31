<?php

    namespace App\Models\Orders;

    use App\Models\Orders\DeliveryDetails\DeliveryDetail;
    use App\Models\Orders\Products\OrderProduct;
    use App\Models\Orders\Statuses\OrderStatus;
    use App\Models\Orders\Types\OrderType;
    use App\Models\Products\Product;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Order
     *
     * @package App\Models\Orders
     */
    class Order extends Model
    {

        /**
         * @var array
         */
        protected $fillable = [
            'status_id', 'name', 'order_type_id'
        ];

        /**
         * @var array
         */
        protected $attributes = [
            'status_id'     => 1,
            'order_type_id' => 1
        ];

        /**
         * @var array
         */
        protected $with = ['order_products', 'status', 'delivery_detail','type'];

        /**
         * @var array
         */
        protected $appends = ['created_at_formatted', 'created_day', 'total_quantity', 'total_amount'];

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

            return $query->orderBy('created_at', 'DESC');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function order_products()
        {
            return $this->hasMany(OrderProduct::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function status()
        {
            return $this->belongsTo(OrderStatus::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasOne
         */
        public function delivery_detail()
        {
            return $this->hasOne(DeliveryDetail::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function type()
        {
            return $this->belongsTo(OrderType::class,'order_type_id');
        }

        /**
         * @return mixed
         */
        public function getCreatedAtFormattedAttribute()
        {
            return $this->created_at->format('d.m.Y - H:i');
        }

        /**
         * @return mixed
         */
        public function getCreatedDayAttribute()
        {
            return $this->created_at->format('l');
        }

        /**
         * @return mixed
         */
        public function getTotalQuantityAttribute()
        {
            return $this->order_products()->sum('quantity');
        }

        /**
         * @return mixed
         */
        public function getTotalAmountAttribute()
        {
            return $this->order_products()->sum('price');
        }
    }
