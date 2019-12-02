<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->index()->nullable()->comment('Промокод');
            $table->unsignedInteger('value')->nullable()->comment('Размер скидки для заказа');
            $table->unsignedBigInteger('max_use_count')->nullable();
            $table->unsignedBigInteger('use_count')->default(0);
            //$table->timestamps(); //Если Вам нужно знать когда был создан промокод, то можно разкоментировать
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocodes');
    }
}
