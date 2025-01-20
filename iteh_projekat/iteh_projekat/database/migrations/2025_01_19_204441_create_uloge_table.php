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
        Schema::create('uloge', function (Blueprint $table) {
            $table->id();
            $table->string('naziv')->unique(); // Dodajemo naziv uloge, koji mora biti jedinstven
            $table->timestamps(); // Automatski dodajemo created_at i updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uloge'); // Brisanje tabele uloga
    }
};
