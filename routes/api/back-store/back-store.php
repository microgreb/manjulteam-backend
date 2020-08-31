<?php

    use Illuminate\Support\Facades\Route;

    Route::post('login', 'AuthController@login');
    Route::post('token', 'AuthController@token');

    Route::group(
        [
            'middleware' => 'api.auth'
        ],
        function() {
            Route::post('logout', 'AuthController@logout');

            Route::get('products', 'ProductsController@index')->name('index');
            Route::post('products', 'ProductsController@store');
            Route::get('products/{product}', 'ProductsController@show');
            Route::get('products/code/{code}', 'ProductsController@getProductByCode');
            Route::patch('products/{product}', 'ProductsController@update');
            Route::delete('products/{product}', 'ProductsController@destroy');

            Route::get('sizes', 'ProductsController@getSizes');

            Route::get('orders/active', 'OrdersController@getActiveOrders');
            Route::get('orders', 'OrdersController@getAllOrders');
            Route::get('orders/finished', 'OrdersController@getFinishedOrders');
            Route::get('orders/offline', 'OrdersController@getOfflineOrders');

            Route::get('orders/statuses', 'OrdersController@getOrdersStatuses');

            Route::post('orders/offline', 'OrdersController@createOfflineOrder');

            Route::patch('orders/{order}/statuses/{status_id}', 'OrdersController@setOrderStatus');
            Route::patch('order-deliveries/{deliveryDetail}/number', 'OrdersController@setOrderDeliveryNumber');

            Route::get('products/{product}/sizes', 'ProductsController@getProductSizes');

            Route::patch('products/{product}/sizes/{size}/quantity', 'ProductsController@updateProductVariationQuantity');

            Route::delete('product-images/{productImage}', 'ProductsController@deleteImage');
            Route::delete('lookbook-images/{lookbookImage}', 'LookbooksController@deleteImage');

            Route::get('lookbooks', 'LookbooksController@index');
            Route::get('lookbooks/{lookbook}', 'LookbooksController@show');
            Route::patch('lookbooks/{lookbook}', 'LookbooksController@update');
            Route::delete('lookbooks/{lookbook}', 'LookbooksController@destroy');
            Route::post('lookbooks', 'LookbooksController@store');
        });
