<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2)->nullable(false); 
            $table->string('status')->default('confirmed');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
