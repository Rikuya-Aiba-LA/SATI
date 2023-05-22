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
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cust_id')->unsigned()->index();
            $table->bigInteger('book_id')->unsigned()->index();
            $table->datetime('lend_date');
            $table->datetime('expectied_date');
            $table->datetime('return_date')->nullable();
            //外部キー設定
            $table->foreign('cust_id')->references('id')
            ->on('customers');
            $table->foreign('book_id')->references('id')
            ->on('books');
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
        Schema::dropIfExists('lendings');
    }
};
