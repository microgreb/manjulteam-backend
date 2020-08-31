<?php

    namespace App\Services\Lookbooks;

    use App\Models\Other\Upload;
    use App\Models\Lookbooks\Lookbook;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;

    /**
     * Class LookbookStoreService
     *
     * @package App\Services\Lookbooks
     */
    class LookbookStoreService
    {
        /**
         * @var Request
         */
        protected $request;

        /**
         * @var
         */
        protected $lookbook;

        /**
         * LookbookStoreService constructor.
         *
         * @param Request $request
         */
        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        /**
         * Store Lookbook & Images
         *
         * @return mixed
         * @throws \Exception
         */
        public function process()
        {
            try {
                DB::beginTransaction();

                $this->lookbook = Lookbook::create($this->request->all());

                $this->processImages();

                Upload::clear();

                DB::commit();

                return $this->lookbook;

            } catch (\Exception $exception) {
                Storage::deleteDirectory($this->lookbook->upload_directory);

                DB::rollBack();
                throw new \Exception($exception);
            }
        }

        public function processUpdate($lookbook)
        {
            try {
            DB::beginTransaction();

            $lookbook->update($this->request->all());

            $this->lookbook = $lookbook;

            $this->processImages();

            Upload::clear();

            DB::commit();

                return $this->lookbook;

            } catch (\Exception $exception) {
                Storage::deleteDirectory($this->lookbook->upload_directory);

                DB::rollBack();
                throw new \Exception($exception);
            }
        }

        /**
         *  Process All Lookbook Images
         *  Including Main Image, Hover, Other
         */
        private function processImages()
        {
            $this->processImage($this->request->main_image, 1);

            if ($this->request->images) {
                foreach ($this->request->images as $image) {
                    $this->processImage($image, 3);
                }
            }
        }

        /**
         * Process Image from request.
         * Moves Picture from Upload into Lookbook folder
         */
        private function processImage($image, $image_type_id)
        {
            if (isset($image['created_at'])) {
                return false;
            }

            if ($image_type_id === 1 || $image_type_id === 2) {
                $this->lookbook->images()->where('image_type_id', $image_type_id)->delete();
            }

            $upload = Upload::whereOriginalName($image['name'])->orderBy('created_at', 'DESC')->firstOrFail();

            Storage::makeDirectory($this->lookbook->upload_directory);

            Storage::copy($upload->path . $upload->file_name, $this->lookbook->upload_directory . $upload->file_name);

            $this->lookbook->images()->create([
                'name'          => $upload->file_name,
                'path'          => $this->lookbook->upload_directory . $upload->file_name,
                'image_type_id' => $image_type_id,
            ]);
        }
    }
