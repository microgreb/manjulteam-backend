<?php

    namespace App\Http\Controllers\Api\FrontStore;

    use App\Http\Controllers\Controller;
    use App\Repositories\NPDeliveryRepository;
    use Illuminate\Http\Request;

    /**
     * Class DeliveryController
     *
     * @package App\Http\Controllers\Api\FrontStore
     */
    class DeliveryController extends Controller
    {
        /**
         * @var NPDeliveryRepository
         */
        protected $np_repository;

        /**
         * DeliveryController constructor.
         */
        public function __construct()
        {
            $this->np_repository = new NPDeliveryRepository();
        }

        /**
         * @return mixed
         */
        public function getAreas()
        {
            return $this->np_repository->getAreas();
        }

        /**
         * @param Request $request
         * @return mixed
         */
        public function getCities(Request $request)
        {
            return $this->np_repository->getCities($request->area, $request->search);
        }

        /**
         * @param Request $request
         * @return mixed
         */
        public function getWareHouses(Request $request)
        {
            return $this->np_repository->getWarehouses($request->city['Ref']);
        }

    }
