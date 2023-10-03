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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('wisata');
            $table->integer('price');
            $table->time('openTime');
            $table->time('closeTime');
            $table->string('access');
            $table->string('address');
            $table->string('numberPhone');
            $table->string('img');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('destinations');
    }
};
