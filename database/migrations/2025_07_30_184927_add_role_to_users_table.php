<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer'); // Varsayılan olarak 'customer' rolü ekliyoruz
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role'); // Geri alma işlemi
        });
    }

};
