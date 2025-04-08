<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMenusTable extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {

        });
    }
    
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['name', 'price', 'stock', 'deskripsi']);
        });
    }
}
