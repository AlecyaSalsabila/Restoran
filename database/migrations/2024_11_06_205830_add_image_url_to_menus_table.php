<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageUrlToMenusTable extends Migration
{
  public function up()
  {
      Schema::table('menus', function (Blueprint $table) {
          $table->string('image_url')->nullable();
      });
  }
  
  public function down()
  {
      Schema::table('menus', function (Blueprint $table) {
          $table->dropColumn('image_url'); 
      });
  }
}
