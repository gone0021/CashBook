<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('');
            $table->integer('user_id')->comment('ユーザーid');
            $table->integer('book_no')->comment('帳簿番号');
            $table->tinyInteger('debit_credit')->comment('貸借判定');
            $table->date('date')->comment('日付');
            $table->tinyInteger('category_id')->comment('科目');
            $table->tinyInteger('kubun_id')->comment('小科目')->nullable();
            $table->integer('price')->comment('金額');
            $table->string('comment', 100)->nullable()->comment('摘要');
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
