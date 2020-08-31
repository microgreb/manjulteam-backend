<?php

    namespace App\Http\Controllers\Api\FrontStore;


    use App\Http\Controllers\Controller;
    use App\Models\Other\Upload;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Image;

    class ImageUploadController extends Controller
    {


        /**
         * Store Product Images
         *
         * @param Request $request
         */
        public function storeProductImages(Request $request)
        {
            if($request->hasFile('file')) {
                $unixtime = Carbon::now()->unix();
                $fileOriginalName = $request->file('file')->getClientOriginalName();

                $nameFull  = $unixtime . '_' . $fileOriginalName;
                $nameMedium = $unixtime . '_medium_' . $fileOriginalName;
                $nameThumb = $unixtime . '_thumb_' . $fileOriginalName;

                $request->file('file')->storeAs('public/images/uploads', $nameFull);
                $request->file('file')->storeAs('public/images/uploads', $nameMedium);
                $request->file('file')->storeAs('public/images/uploads', $nameThumb);

                //Resize stored images
                $fullPath = public_path('storage/images/uploads/' . $nameFull);
                Image::make($fullPath)->resize(1920, 1272, function($constraint) {
                    $constraint->aspectRatio();
                })->save($fullPath);

                $mediumPath = public_path('storage/images/uploads/' . $nameMedium);
                Image::make($mediumPath)->resize(480, 318, function($constraint) {
                    $constraint->aspectRatio();
                })->save($mediumPath);

                $thumbnailPath = public_path('storage/images/uploads/' . $nameThumb);
                Image::make($thumbnailPath)->resize(200, 160, function($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnailPath);

                Upload::create([
                    'original_name' => $fileOriginalName,
                    'file_name'     => $nameFull,
                    'path'          => 'public/images/uploads'
                ]);
                Upload::create([
                    'original_name' => 'medium_' . $fileOriginalName,
                    'file_name'     => $nameMedium,
                    'path'          => 'public/images/uploads'
                ]);
                Upload::create([
                    'original_name' => 'thumb_' .$fileOriginalName,
                    'file_name'     => $nameThumb,
                    'path'          => 'public/images/uploads'
                ]);
            }
        }

        /**
         * Store Product Images
         *
         * @param Request $request
         */
        public function storeLookbookImages(Request $request)
        {
            $file = $request->file('file');

            $name = Carbon::now()->unix() . '_' . $request->file->getClientOriginalName();

            $file->storeAs('public/images/uploads', $name);

            Upload::create([
                'original_name' => $request->file->getClientOriginalName(),
                'file_name'     => $name,
                'path'          => 'public/images/uploads'
            ]);
        }
    }
