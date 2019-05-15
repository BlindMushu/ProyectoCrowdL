<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('article_id')->unsigned();
            $table->bigInteger('amount');
            $table->bigInteger('amount_sale')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('flag_if_sale')->default(0);
        });

        Schema::table('invests', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invests', function(Blueprint $table)
    {
        //$table->dropForeign('payments_invests_invest_id_foreign');
    });
        Schema::dropIfExists('invests');
    }
}
