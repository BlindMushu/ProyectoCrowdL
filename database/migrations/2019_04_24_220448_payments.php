<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('article_id')->unsigned();
            $table->integer('num_pay');
            $table->decimal('interest_amount', 11, 2);
            $table->decimal('capital_amount', 11, 2);
            $table->decimal('pay', 11, 2);
            $table->decimal('balance', 11, 2);
            $table->timestamps();
            $table->date('payday')->nullable();
            $table->date('paid_day')->nullable();
            $table->bigInteger('flag_if_payed')->default(0);
            $table->softDeletes();
        });

        Schema::table('payments', function (Blueprint $table) {

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

        Schema::create('payments_invests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payment_id')->unsigned();
            $table->bigInteger('invest_id')->unsigned();
            $table->integer('flag_if_payed')->default(0);
            $table->decimal('interest_amount', 11, 2);
            $table->decimal('capital_amount', 11, 2);
            $table->decimal('pay', 11, 2);
            $table->decimal('balance', 11, 2);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('payments_invests', function (Blueprint $table) {

            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('invest_id')->references('id')->on('invests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('payments_invests', function(Blueprint $table)
    {
        $table->dropForeign('payments_invests_payment_id_foreign');
        $table->dropForeign('payments_invests_invest_id_foreign');
    });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('payment_invests');
        Schema::dropIfExists('payments');
    }
}
