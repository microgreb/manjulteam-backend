<?php

    namespace App\Http\Controllers\Api\BackStore;

    use App\Models\Orders\DeliveryDetails\DeliveryDetail;
    use App\Models\Orders\Order;
    use App\Models\Orders\Statuses\OrderStatus;
    use App\Services\Orders\OfflineOrderStoreService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    /**
     * Class OrdersController
     *
     * @package App\Http\Controllers\Api\FrontStore
     */
    class OrdersController extends BaseController
    {

        /**
         * @return mixed
         */
        public function getActiveOrders(Request $request)
        {
            return Order::where('order_type_id', 1)->when(hasValue($request->status_id), function ($q) use ($request) {
                $q->where('status_id', $request->status_id);
            })->get();
        }

        /**
         * @return mixed
         */
        public function getOfflineOrders()
        {
            return Order::where('order_type_id', 2)->get();
        }

        /**
         * @return Order[]|\Illuminate\Database\Eloquent\Collection
         */
        public function getAllOrders()
        {
            return Order::all();
        }

        /**
         * @return mixed
         */
        public function getFinishedOrders(Request $request)
        {
            return Order::where('status_id', '=', 3)->when(hasValue($request->order_type_id), function ($q) use ($request) {
                $q->where('order_type_id', $request->order_type_id);
            })->when(hasValue($request->month), function ($q) use ($request) {
                $q->whereMonth('created_at', '=', $request->month);
            })->when(hasValue($request->dates), function ($q) use ($request) {
                $q->whereIn(DB::raw("DATE(created_at)"), formatDates($request->dates));
            })->get();
        }

        /**
         * Get Order Statuses
         *
         * @return OrderStatus[]|\Illuminate\Database\Eloquent\Collection
         */
        public function getOrdersStatuses()
        {
            return OrderStatus::all();
        }

        /**
         * Update Order Status
         *
         * @param Order $order
         * @param int $status_id
         * @return Order
         */
        public function setOrderStatus(Order $order, int $status_id)
        {
            $order->update(['status_id' => $status_id]);

            return $order;
        }

        /**
         * @param DeliveryDetail $deliveryDetail
         * @param Request $request
         * @return DeliveryDetail
         */
        public function setOrderDeliveryNumber(DeliveryDetail $deliveryDetail, Request $request)
        {
            $deliveryDetail->update(['np_delivery_number' => $request->np_delivery_number]);

            return $deliveryDetail;
        }

        /**
         * @param Request $request
         * @throws \Exception
         */
        public function createOfflineOrder(Request $request)
        {
            (new OfflineOrderStoreService($request))->process();
        }
    }
