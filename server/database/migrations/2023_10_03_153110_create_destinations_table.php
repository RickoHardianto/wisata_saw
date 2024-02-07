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
            $table->text('deskripsi');
            $table->integer('price');
            $table->integer('penginapan');
            $table->integer('jarak');
            $table->time('openTime');
            $table->time('closeTime');
            $table->string('access');
            $table->string('address');
            $table->string('kecamatan');
            $table->string('numberPhone');
            $table->string('img');
            $table->string('img_lokasi');
            $table->string('status')->nullable();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
