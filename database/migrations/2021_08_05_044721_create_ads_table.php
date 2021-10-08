<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('ads_title');
            $table->integer('ads_price')->nullable();
            $table->integer('ads_type')->default(1);
            $table->string('ads_owner_name');
            $table->string('ads_owner_email');
            $table->string('ads_owner_phone');
            $table->string('ads_address')->nullable();
            $table->string('ads_image_url');
            $table->string('ads_link');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('ads');
    }
}
