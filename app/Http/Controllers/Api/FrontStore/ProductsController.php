<?php

    namespace App\Http\Controllers\Api\FrontStore;


    use App\Http\Controllers\Controller;
    use App\Models\Other\Upload;
    use App\Models\Products\Product;
    use App\Models\Products\Sizes\Size;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    /**
     * Class ProductsController
     *
     * @package App\Http\Controllers\Api\FrontStore
     */
    class ProductsController extends Controller
    {


        /**
         * @return Product[]|\Illuminate\Database\Eloquent\Collection
         */
        public function index()
        {
            return Product::all();
        }

        /**
         * @return mixed
         */
        public function getMaleProducts()
        {
            return Product::whereGender(1)->get();
        }

        /**
         * @return mixed
         */
        public function getFemaleProducts()
        {
            return Product::whereGender(2)->get();
        }

        /**
         * @return mixed
         */
        public function getUnisexProducts()
        {
            return Product::whereGender(3)->get();
        }

        /**
         * @return mixed
         */
        public function getFeaturedProducts()
        {
            return Product::whereFeatured(true)->get();
        }

        /**
         * @param Product $product
         * @return Product
         */
        public function show(Product $product)
        {
            return $product;
        }

        /**
         * @param Product $product
         * @return Size[]|\Illuminate\Database\Eloquent\Collection
         */
        public function getProductSizes(Product $product)
        {
            return Size::with(['specific_product_variation' => function ($q) use ($product) {
                return $q->where('product_id', $product->id);
            }])->get();
        }

    }
