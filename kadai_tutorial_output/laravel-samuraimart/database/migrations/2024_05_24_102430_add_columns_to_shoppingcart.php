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
        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->string('code')->default("");
            $table->integer('price_total')->unsigned()->default(0);
            $table->integer('qty')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('price_total');
            $table->dropColumn('qty');
        });
    }
};
