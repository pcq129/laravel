<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->unsignedBigInteger('id')->autoIncrement()->change();
            $table->unsignedBigInteger('customer_id')->change();
            $table->boolean('isServed')->after('status');
            $table->string('status', 30)->default('-')->change();
            // $table->dropColumn('payment_mode');
            // $table->string('payment_mode', 30)->default("-")->change();
            // $table->json('order_data')->after('isServed');
            $table->dropColumn('rating');
            // $table->enum('rating', ['1','2','3','4','5'])->nullable(true)->default(null)->change();
            $table->string('comment', 180)->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->increments('id')->unsigned()->change();
            $table->integer('customer_id')->change();
            // $table->dropColumn('order_data');
            $table->dropColumn('isServed');

        });
    }

};
