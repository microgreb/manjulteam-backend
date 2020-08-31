<?php

    namespace App\Http\Controllers\Api\BackStore;

    use App\Models\Lookbooks\Lookbook;
    use App\Services\Lookbooks\LookbookStoreService;
    use Illuminate\Http\Request;
	use App\Models\Lookbooks\Images\LookbookImage;

    /**
     * Class LookbooksController
     *
     * @package App\Http\Controllers\Api\FrontStore
     */
    class LookbooksController extends BaseController
    {

        /**
         * @return Lookbook[]|\Illuminate\Database\Eloquent\Collection
         */
        public function index()
        {
            return Lookbook::all();
        }

        /**
         * @param Lookbook $lookbook
         * @return Lookbook
         */
        public function show(Lookbook $lookbook)
        {
            return $lookbook;
        }

        /**
         * @param Lookbook $lookbook
         * @return Lookbook
         */
        public function update(Lookbook $lookbook, Request $request)
        {
            $lookbook = (new LookbookStoreService($request))->processUpdate($lookbook);

            return $lookbook;
        }

		/**
         * @param LookbookImage $lookbookImage
         * @throws \Exception
         */
        public function deleteImage(LookbookImage $lookbookImage)
        {
            $lookbookImage->delete();
        }

        /**
         * @param Request $request
         * @return mixed
         */
        public function store(Request $request)
        {
            $product = (new LookbookStoreService($request))->process();

            return $product;
        }

        /**
         * @param Lookbook $lookbook
         * @throws \Exception
         */
        public function destroy(Lookbook $lookbook)
        {
            $lookbook->images()->delete();

            $lookbook->delete();
        }
    }
