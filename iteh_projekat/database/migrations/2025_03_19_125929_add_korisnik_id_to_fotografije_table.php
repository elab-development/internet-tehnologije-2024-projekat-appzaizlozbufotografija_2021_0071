<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fotografije', function (Blueprint $table) {
            $table->foreignId('korisnik_id')->constrained('korisnici')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('fotografije', function (Blueprint $table) {
            $table->dropForeign(['korisnik_id']);
            $table->dropColumn('korisnik_id');
        });
    }
};
