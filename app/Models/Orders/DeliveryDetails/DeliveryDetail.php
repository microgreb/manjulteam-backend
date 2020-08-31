<?php

    namespace App\Models\Orders\DeliveryDetails;

    use Illuminate\Database\Eloquent\Model;

    /**
     * Class DeliveryDetail
     *
     * @package App\Models\Orders\DeliveryDetails
     */
    class DeliveryDetail extends Model
    {

        /**
         * @var array
         */
        protected $fillable = [
            'np_delivery_number', 'full_name', 'phone', 'city', 'np_department', 'comment'
        ];

        /**
         * @var array
         */
        protected $appends = [];

        /**
         * @var array
         */
        protected $attributes = [];

    }
