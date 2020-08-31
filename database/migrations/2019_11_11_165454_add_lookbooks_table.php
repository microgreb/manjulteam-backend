<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddLookbooksTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('lookbooks', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->timestamps();
            });

            Schema::create('lookbook_images', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('path');
                $table->unsignedBigInteger('lookbook_id');
                $table->foreign('lookbook_id')->references('id')->on('lookbooks');
                $table->unsignedBigInteger('image_type_id');
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
            Schema::dropIfExists('lookbook_images');
            Schema::dropIfExists('lookbooks');
        }
    }
