<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('irs', function (Blueprint $table) {
            $table->integer('total_sks')->default(0);
        });
    }

    public function down()
    {
        Schema::table('irs', function (Blueprint $table) {
            $table->dropColumn('total_sks');
        });
    }
};
