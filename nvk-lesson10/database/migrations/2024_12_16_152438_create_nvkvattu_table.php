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
        Schema::create('nvkvattu', function (Blueprint $table) {
            //$table->id();
            $table->string('nvkMaVTu')->primary();
            $table->string('nvkTenVTu')->unique();
            $table->string('nvkDvTinh');
            $table->string('nvkPhanTram');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nvkvattu');
    }
};
