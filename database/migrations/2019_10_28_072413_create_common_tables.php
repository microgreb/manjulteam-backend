<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateCommonTables extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('size_groups', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->timestamps();
            });

            Schema::create('sizes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('size_group_id');
                $table->foreign('size_group_id')->references('id')->on('size_groups');
                $table->string('name');
                $table->timestamps();
            });


            Schema::create('products', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('code');
                $table->string('color')->nullable();
                $table->string('price');
                $table->string('gender');
                $table->text('description');
                $table->boolean('featured')->default(0);
                $table->timestamps();
            });

            Schema::create('product_image_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->timestamps();
            });

            Schema::create('product_images', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('path');
                $table->unsignedBigInteger('product_id');
                $table->foreign('product_id')->references('id')->on('products');
                $table->unsignedBigInteger('image_type_id');
                $table->foreign('image_type_id')->references('id')->on('product_image_types');
                $table->timestamps();
            });


            Schema::create('product_variations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('product_id');
                $table->foreign('product_id')->references('id')->on('products');
                $table->unsignedBigInteger('size_id');
                $table->foreign('size_id')->references('id')->on('sizes');
                $table->integer('quantity');
                $table->timestamps();
            });

            Schema::create('order_statuses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->timestamps();
            });

            Schema::create('order_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->timestamps();
            });

            Schema::create('orders', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->unsignedBigInteger('order_type_id');
                $table->foreign('order_type_id')->references('id')->on('order_types');
                $table->unsignedBigInteger('status_id');
                $table->foreign('status_id')->references('id')->on('order_statuses');
                $table->unsignedInteger('price');
                $table->timestamps();
            });

            Schema::create('delivery_details', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('full_name');
                $table->string('phone');
                $table->string('city');
                $table->string('np_department');
                $table->string('comment')->nullable();
                $table->unsignedBigInteger('order_id');
                $table->foreign('order_id')->references('id')->on('orders');
                $table->timestamps();
            });


            Schema::create('order_products', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('order_id');
                $table->foreign('order_id')->references('id')->on('orders');
                $table->unsignedBigInteger('product_id');
                $table->foreign('product_id')->references('id')->on('products');
                $table->unsignedBigInteger('size_id');
                $table->foreign('size_id')->references('id')->on('sizes');
                $table->integer('quantity');
                $table->timestamps();
            });

        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('order_products');
            Schema::dropIfExists('delivery_details');
            Schema::dropIfExists('orders');
            Schema::dropIfExists('order_types');
            Schema::dropIfExists('order_statuses');
            Schema::dropIfExists('product_variations');
            Schema::dropIfExists('product_images');
            Schema::dropIfExists('product_image_types');
            Schema::dropIfExists('products');
            Schema::dropIfExists('sizes');
            Schema::dropIfExists('size_groups');
        }
    }
