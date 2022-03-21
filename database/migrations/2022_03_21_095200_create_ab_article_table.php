<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_article', function (Blueprint $table) {
            $table->id();
            $table->timestamp('ab_createdate')->default(Carbon::now());
            $table->integer('ab_price')->nullable(false);
            $table->unsignedBigInteger('ab_creator_id');
            $table->foreign('ab_creator_id')->references('id')->on('ab_user');
            $table->string('ab_description',1000)->nullable(false);
            $table->string('ab_name',80)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_article');
    }
};
