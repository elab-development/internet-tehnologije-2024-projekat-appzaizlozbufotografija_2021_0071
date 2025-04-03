<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::table('galerije', function (Blueprint $table) {
            $table->string('slika')->nullable()->after('opis'); // Dodajemo polje za sliku
        });
        
    }

    public function down(): void
    {
        Schema::table('galerije', function (Blueprint $table) {
            $table->dropColumn('slika');
        });
    }
};
