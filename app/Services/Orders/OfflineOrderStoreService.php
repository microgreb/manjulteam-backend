<?php

    namespace App\Services\Orders;

    use App\Models\Orders\Order;
    use App\Models\Products\Product;
    use App\Models\Products\Sizes\Size;
    use App\Models\Products\Variations\ProductVariation;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    /**
     * Class OrderStoreService
     *
     * @package App\Services
     */
    class OfflineOrderStoreService
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
        public function process()
        {
            try {
                DB::beginTransaction();

                $order = Order::create(
                    ['name'          => rand(1000, 3000),
                     'order_type_id' => 2,
                     'status_id'     => 3
                    ]);

                foreach ($this->request->order_items as $order_item) {
                    if ($order_item['useStorage']) {
                        $this->handleStorageProduct($order, $order_item);
                    } else {
                        $this->handleManualProduct($order, $order_item);
                    }
                }

                DB::commit();

                return $order;

            } catch (\Exception $exception) {
                DB::rollBack();
                throw new \Exception($exception);
            }
        }

        /**
         * @param $order
         * @param $order_item
         */
        private function handleStorageProduct($order, $order_item)
        {
            $product = Product::findOrFail($order_item['product']['id']);
            $variation = ProductVariation::all()->get($order_item['selectedVariation']);
            $quantity = $order_item['quantity'];
            $price = $order_item['price'] * $quantity;
            $order->order_products()->create(
                [
                    'product_id' => $product->id,
                    'size_id'    => $variation['size']['id'],
                    'quantity'   => $quantity,
                    'price'      => $price,
                ]
            );

            $variation->update(['quantity' => ($variation->quantity - $quantity)]);
        }

        /**
         * @param $order
         * @param $order_item
         */
        private function handleManualProduct($order, $order_item)
        {
            $product = Product::findOrFail($order_item['product']['id']);
            $size = Size::findOrFail($order_item['selectedSize']);
            $quantity = $order_item['quantity'];
            $price = $order_item['price'] * $quantity;
            $order->order_products()->create(
                [
                    'product_id' => $product->id,
                    'size_id'    => $size->id,
                    'quantity'   => $quantity,
                    'price'      => $price,
                ]
            );
        }
    }
