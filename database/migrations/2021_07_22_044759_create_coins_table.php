<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('logo');
            $table->string('symbol');
            $table->foreignId('network_id')->nullable();
            $table->boolean('ispresale')->default(0);
            $table->string('contract_address');
            $table->text('description');
            $table->string('cart_link')->nullable();
            $table->string('swap_link')->nullable();
            $table->string('website_link');
            $table->datetime('launch_at')->nullable();
            $table->string('telegram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('discord_link')->nullable();
            $table->integer('status')->default(1);//'listed'
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
        Schema::dropIfExists('coins');
    }
}
