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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clothes_id');
            $table->foreignId('user_booking_id');
            $table->foreignId('admin_id');
            $table->string('size_cloth');
            $table->integer('quantity');
            $table->integer('weight_product');
            $table->integer('subtotal');
            // $table->text('order_desc')->nullable();
            $table->timestamps();
        });
    }

    /**last: 'alsyam' ,
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
