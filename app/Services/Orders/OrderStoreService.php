<?php

    namespace App\Services\Orders;

    use App\Models\Orders\Order;
    use App\Models\Products\Product;
    use App\Models\Products\Variations\ProductVariation;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    /**
     * Class OrderStoreService
     *
     * @package App\Services
     */
    class OrderStoreService
    {

        /**
         * @var Request
         */
        protected $request;

        /**
         * OrderStoreService constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        /**
         *
         */
        public function process($status_id = 50)
        {
            try {
                DB::beginTransaction();

                $order = Order::create(
                    ['name'          => rand(1000, 3000),
                     'order_type_id' => 1,
                     'status_id'     => $status_id
                    ]);

                $order->delivery_detail()->create([
                    'city'          => $this->request->deliveryDetails['city'],
                    'full_name'     => $this->request->deliveryDetails['full_name'],
                    'phone'         => $this->request->deliveryDetails['phone'],
                    'comment'       => $this->request->deliveryDetails['comment'],
                    'np_department' => $this->request->deliveryDetails['address'],
                ]);

                foreach ($this->request->order_items as $order_item) {
                    $product = Product::findOrFail($order_item['product']['id']);
                    $variation = ProductVariation::findOrFail($order_item['variation']['id']);
                    $quantity = $order_item['quantity'];
                    $price = $product->price * $quantity;
                    $order->order_products()->create(
                        [
                            'product_id' => $product->id,
                            'size_id'    => $variation['size']['id'],
                            'quantity'   => $quantity,
                            'price'      => $price,
                        ]
                    );
                }

                DB::commit();

                return $order;

            } catch (\Exception $exception) {
                DB::rollBack();
                throw new \Exception($exception);
            }
        }
    }
