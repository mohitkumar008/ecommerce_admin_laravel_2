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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->integer('section_id');
            $table->string('category_name');
            $table->string('category_image')->nullable();
            $table->float('category_discount')->nullable();
            $table->text('description')->nullable();
            $table->string('url');
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->string('meta_keyword')->nullable();
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
        Schema::dropIfExists('categories');
    }
};