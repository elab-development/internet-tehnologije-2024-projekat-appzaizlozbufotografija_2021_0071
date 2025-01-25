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
        Schema::create('korisnici', function (Blueprint $table) {
            $table->id();
            $table->string('ime');
            $table->string('prezime');
            $table->string('email')->unique();
            $table->string('lozinka');
            $table->timestamps();
        });
        Schema::table('korisnici', function (Blueprint $table) {
            $table->string('remember_token', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('korisnici', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
        Schema::dropIfExists('korisnici');
    }
};
