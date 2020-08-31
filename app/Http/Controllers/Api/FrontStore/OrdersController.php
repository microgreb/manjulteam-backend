<?php

    namespace App\Http\Controllers\Api\FrontStore;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\OrderStoreRequest;
    use App\Services\Orders\OrderStoreService;
    use App\Services\Orders\Payments\LiqpayPaymentService;
    use Illuminate\Http\Request;

    /**
     * Class OrdersController
     *
     * @package App\Http\Controllers\Api\FrontStore
     */
    class OrdersController extends Controller
    {
        /**
         * @param Request $request
         * @return array
         * @throws \Exception
         */
        public function storeOrder(OrderStoreRequest $request)
        {
            $order = (new OrderStoreService($request))->process();

            if( $request->paysystem == 'liqpay' ) {
                $signature = (new LiqpayPaymentService($order))->process();
            }
            elseif( $request->paysystem == 'anymoney' ) {
                // ToDo continue here, making AnymoneyPaymentService
            }

            return $signature;
        }
    }
