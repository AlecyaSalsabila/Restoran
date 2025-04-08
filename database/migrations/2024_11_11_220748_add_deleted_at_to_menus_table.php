<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      
        if (!Schema::hasColumn('menus', 'deleted_at')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }
    
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropSoftDeletes(); 
        });
    }
};   