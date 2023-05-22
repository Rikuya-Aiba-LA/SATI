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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->bigInteger('classify_id')->unsigned()->index();
            $table->string('author',100);
            $table->string('publisher', 100);
            $table->char('isbn', 13);
            $table->datetime('publish_date');
            $table->datetime('trash_date')->nullable();
            //外部キー設定
            $table->foreign('classify_id')->references('id')
            ->on('classifies');
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
        Schema::dropIfExists('books');
    }
};
