<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('product_url');
            $table->string('product_code');
            $table->string('product_color')->nullable();
            $table->float('product_mrp');
            $table->float('product_price')->nullable();
            $table->float('product_weight')->nullable();
            $table->string('product_video')->nullable();
            $table->string('product_image');
            $table->text('product_short_desc');
            $table->text('product_long_desc');
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->enum('is_featured', ['No', 'Yes']);
            $table->tinyInteger('status')->defaultValue(1);
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
        Schema::dropIfExists('products');
    }
};
