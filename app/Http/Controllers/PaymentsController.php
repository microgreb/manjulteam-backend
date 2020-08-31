<?php

    namespace App\Http\Controllers;

    use App\Models\Orders\Order;
    use App\Models\Products\Images\ProductImage;
    use App\Models\Products\Variations\ProductVariation;
    use App\Services\Orders\OrderFulfillService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Intervention\Image\Facades\Image;
    use Intervention\Image\Response;


    class PaymentsController extends Controller
    {
        public function handlePaymentResponse(Order $order, Request $Request)
        {
            (new OrderFulfillService($order))->process();
        }

        public function test()
        {
            return view('payment');
            $imageSource = ProductImage::first();

            $cacheimage = Image::cache(function ($image) use ($imageSource) {
                return $image->make(url(Storage::url($imageSource->path)))->resize(100, 50);
            }, 10, true);

            dd([$cacheimage->response()]);
        }
    }
