<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuOrderTable extends Migration
{
    public function up()
    {
        Schema::create('menu_order', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_order');
    }
}
