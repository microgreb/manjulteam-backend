<?php

    namespace App\Services\Orders\Payments;


    use App\Libraries\LiqpayApi;
    use App\Models\Orders\Order;

    class LiqpayPaymentService
    {
        /**
         * @var
         */
        protected $signature;
        /**
         * @var Order
         */
        protected $order;

        protected $liqpay;

        /**
         * LiqpayPaymentService constructor.
         *
         * @param Order $order
         */
        public function __construct(Order $order)
        {
            $this->order = $order;

            $this->liqpay = new LiqpayApi(env('LIQPAY_PUBLIC_KEY', 'i33693612797'), env('LIQPAY_PRIVATE_KEY', '9DWthCrz9mVqtg5AZxeahTABUU1tPz3NxEdA4Q6C'));
        }

        /**
         * @return array
         */
        public function process()
        {
            $payload = $this->generateData();

            return [
                'data'      => base64_encode(json_encode($payload)),
                'signature' => $this->liqpay->cnb_signature($payload),
            ];
        }


        protected function generateData()
        {
            return [
                'action'      => 'pay',
                'amount'      => $this->order->total_amount,
                'public_key'  => env('LIQPAY_PUBLIC_KEY', 'i33693612797'),
                'currency'    => 'UAH',
                'description' => 'Покупка товаров.',
                'orderId'     => $this->order->id,
                'version'     => 3,
                'sandbox'     => 1,
                'result_url'  => 'http://manjulteam.com',
                'server_url'  => url('payments/orders/' . $this->order->id),
            ];
        }

    }
