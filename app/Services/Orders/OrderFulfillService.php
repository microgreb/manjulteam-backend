<?php

    namespace App\Services\Orders;

    use App\Models\Orders\Order;
    use App\Models\Products\Variations\ProductVariation;
    use Illuminate\Support\Facades\DB;

    class OrderFulfillService
    {
        protected $order;

        public function __construct(Order $order)
        {
            $this->order = $order;
        }

        public function process()
        {
            try {
                DB::beginTransaction();

                $this->order->update(['status_id' => 1]);

                foreach ($this->order->order_products as $order_product) {
                    $variation = ProductVariation::where('product_id', $order_product->product_id)->where('size_id', $order_product->size_id)->firstOrFail();
                    $variation->update(['quantity' => ($variation->quantity - $order_product->quantity)]);
                }

                DB::commit();

            } catch (\Exception $exception) {

                DB::rollBack();
                throw new \Exception($exception);

            }
        }
    }
