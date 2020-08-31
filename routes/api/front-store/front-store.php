<?php


    Route::get('products', 'ProductsController@index');
    Route::get('products/category/men', 'ProductsController@getMaleProducts');
    Route::get('products/category/women', 'ProductsController@getFemaleProducts');
    Route::get('products/category/unisex', 'ProductsController@getUnisexProducts');
    Route::get('products/category/featured', 'ProductsController@getFeaturedProducts');
    Route::get('products/category/all', 'ProductsController@index');
    Route::get('products/{product}', 'ProductsController@show');
    Route::get('products/{product}/sizes', 'ProductsController@getProductSizes');


    Route::get('delivery/areas', 'DeliveryController@getAreas');
    Route::post('delivery/areas/cities/query', 'DeliveryController@getCities');
    Route::post('delivery/areas/cities/warehouses', 'DeliveryController@getWareHouses');

    Route::post('orders', 'OrdersController@storeOrder');


    Route::post('products/images', 'ImageUploadController@storeProductImages');
    Route::post('lookbooks/images', 'ImageUploadController@storeLookbookImages');


    Route::get('lookbooks','LookbooksController@getLookbooks');
    Route::get('lookbooks/{lookbook}','LookbooksController@getLookbook');
