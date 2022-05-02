<?php

use Carbon\Carbon;
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
        Schema::create('ab_shoppingcart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ab_creator_id');
            $table->foreign('ab_creator_id')->references('id')->on('ab_user')->onDelete('cascade');
            $table->timestamp('ab_createdate')->default(Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_shoppingcart');
    }
};
