<?php

    namespace App\Http\Controllers\Api\BackStore;

    use App\Models\Products\Images\ProductImage;
    use App\Models\Products\Product;
    use App\Models\Products\Sizes\Size;
    use App\Models\Products\Variations\ProductVariation;
    use App\Services\Products\ProductStoreService;
    use Illuminate\Http\Request;

    /**
     * Class ProductsController
     *
     * @package App\Http\Controllers\Api\FrontStore
     */
    class ProductsController extends BaseController
    {
        /**
         * @return Product[]|\Illuminate\Database\Eloquent\Collection
         */
        public function index(Request $request)
        {
            $catogory = (int) $request->get('category');
            $availability = $request->get('availability', '');
            return Product::when($catogory, function ($q) use ($catogory) {
                $q->where('gender', $catogory);
            })->when($availability, function ($q) use ($availability) {
                switch ($availability) {
                    case 'in_stock':
                        $q->whereHas('variations');
                        break;
                    case 'out_stock':
                        $q->whereDoesnthave('variations');
                        break;
                }
            })->get();
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
         * @param Request $request
         * @return mixed
         */
        public function store(Request $request)
        {
            $product = (new ProductStoreService($request))->process();

            return $product;
        }

        /**
         * @param Product $product
         * @param Request $request
         * @return Product
         * @throws \Exception
         */
        public function update(Product $product, Request $request)
        {
            $product = (new ProductStoreService($request))->processUpdate($product);

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

        /**
         * @param ProductVariation $productVariation
         * @param Request $request
         */
        public function updateProductVariationQuantity(Product $product, Size $size, Request $request)
        {
            $productVariation = ProductVariation::firstorCreate([
                'product_id' => $product->id,
                'size_id'    => $size->id
            ]);

            if (!$request->quantity) {
                $productVariation->delete();
            } else {
                $productVariation->update(['quantity' => $request->quantity]);
            }

            return $productVariation;
        }

        /**
         * @param string $productImage
         * @throws \Exception
         */
        public function deleteImage($productImage)
        {
            $image = ProductImage::findOrFail($productImage);
            $image->delete();
        }

        /**
         * @param string $code
         * @return mixed
         */
        public function getProductByCode(string $code)
        {
            return Product::whereCode($code)->firstOrFail();
        }

        /**
         *
         * @param Product $product
         * @throws \Exception
         */
        public function destroy(Product $product)
        {

            $product->orders()->sync([]);

            $product->images()->delete();

            $product->sizes()->sync([]);

            $product->variations()->delete();

            $product->delete();
        }

        /**
         * @return Size[]|\Illuminate\Database\Eloquent\Collection
         */
        public function getSizes()
        {
            return Size::all();
        }
    }
