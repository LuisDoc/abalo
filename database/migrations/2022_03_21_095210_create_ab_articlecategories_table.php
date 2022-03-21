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
        Schema::create('ab_articlecategory', function (Blueprint $table) {
            $table->id();
            $table->string('ab_name',100)->nullable(false)->unique();
            $table->string('ab_description',1000)->nullable(true);
            $table->unsignedBigInteger('ab_parent')->nullable(true);
            $table->foreign('ab_parent')->references('id')->on('ab_articlecategory')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_articlecategory');
    }
};
