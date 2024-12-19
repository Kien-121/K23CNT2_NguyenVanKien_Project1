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
        Schema::create('NVK_LOAI_SAN_PHAM', function (Blueprint $table) {
            $table->id();
            $table->string('nvkMaLoai',255)->unique();
            $table->string('nvkTenLoai',255);
            $table->TinyInteger('nvkTranThai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NVK_LOAI_SAN_PHAM');
    }
};
