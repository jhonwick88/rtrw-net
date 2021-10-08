<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumPresaleInCoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->string('presale_link')->after('status')->nullable();
            $table->string('marketcap')->after('status')->nullable();
            $table->string('price_usd')->after('status')->nullable();
            $table->string('price_bnb')->after('status')->nullable();
            $table->json('options')->after('status')->nullable();
            $table->boolean('ispromoted')->after('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coin', function (Blueprint $table) {
            //
        });
    }
}
