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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unique()->unsigned();
            // $table->id();
            $table->integer('customer_id');
            $table->enum('payment_mode',['Cash', 'Online']);
            $table->enum('status', ['completed', 'pending', '-']);
            $table->integer('amount');
            $table->enum('rating', ['1','2','3','4','5']);
            $table->string('comment', 180);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
