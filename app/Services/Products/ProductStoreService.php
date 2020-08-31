<?php

    namespace App\Services\Products;

    use App\Models\Other\Upload;
    use App\Models\Products\Product;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;

    /**
     * Class ProductStoreService
     *
     * @package App\Services\Products
     */
    class ProductStoreService
    {
        /**
         * @var Request
         */
        protected $request;

        /**
         * @var
         */
        protected $product;

        /**
         * ProductStoreService constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        /**
         * Store Product & Images
         *
         * @return mixed
         * @throws \Exception
         */
        public function process()
        {

            if( count( $this->request->get('images') ) == 0 ) {
                return [ 'error' => 'Необходимо загрузить изображение' ];
            }
            try {

                DB::beginTransaction();
                $this->product = Product::create($this->request->all());
                $this->processImages();
                Upload::clear();
                DB::commit();

                return $this->product;

            } catch (\Exception $exception) {

                Storage::deleteDirectory($this->product->upload_directory);
                DB::rollBack();
                throw new \Exception($exception);
            }
        }

        public function processUpdate($product)
        {
//            try {
            DB::beginTransaction();

            $product->update($this->request->all());

            $this->product = $product;

            $this->processImages();

            Upload::clear();

            DB::commit();
        }

        /**
         *  Process All Product Images
         *  Including Main Image, Hover, Other
         */
        private function processImages()
        {
            $this->processImage($this->request->main_image, 1);

            $this->processImage($this->request->hover_image, 2);

            $additionalImages = $this->request->images;

            if ($additionalImages) {
                foreach ($additionalImages as $image) {
                    $this->processImage($image, 3);
                }
            }
        }

        /**
         * Process Image from request.
         * Moves Picture from Upload into Product folder
         */
        private function processImage($image, $image_type_id)
        {
            if (isset($image['created_at'])) {
                return false;
            }

            if ($image_type_id === 1 || $image_type_id === 2) {
                $this->product->images()->where('image_type_id', $image_type_id)->delete();
            }

            $upload = Upload::whereOriginalName($image['name'])->orderBy('created_at', 'DESC')->firstOrFail();

            Storage::makeDirectory($this->product->upload_directory);

            Storage::copy( $upload->path . $upload->file_name, $this->product->upload_directory . $upload->file_name);

            $medium = Upload::whereOriginalName('medium_' . $image['name'])->orderBy('created_at', 'DESC')->firstOrFail();
            Storage::copy( $medium->path . $medium->file_name, $this->product->upload_directory . $medium->file_name);
            $medium->delete();

            if ($image_type_id === 1) {
                $thumbnail = Upload::whereOriginalName('thumb_' . $image['name'])->orderBy('created_at', 'DESC')->firstOrFail();
                Storage::copy($thumbnail->path . $thumbnail->file_name, $this->product->upload_directory . $thumbnail->file_name);
                $thumbnail->delete();
            }

            $this->product->images()->create([
                'name'          => $upload->file_name,
                'path'          => $this->product->upload_directory . $upload->file_name,
                'image_type_id' => $image_type_id,
            ]);
        }
    }
