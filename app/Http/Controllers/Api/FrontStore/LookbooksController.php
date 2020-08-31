<?php

    namespace App\Http\Controllers\Api\FrontStore;

    use App\Http\Controllers\Controller;
    use App\Models\Lookbooks\Lookbook;
    use App\Repositories\NPDeliveryRepository;
    use Illuminate\Http\Request;

    /**
     * Class LookbooksController
     *
     * @package App\Http\Controllers\Api\FrontStore
     */
    class LookbooksController extends Controller
    {

        /**
         * @return mixed
         */
        public function getLookbooks()
        {
            return Lookbook::orderBy('created_at', 'DESC')->get();
        }

        /**
         * @param Lookbook $lookbook
         * @return Lookbook
         */
        public function getLookbook(Lookbook $lookbook)
        {
            return $lookbook;
        }

  
    }
