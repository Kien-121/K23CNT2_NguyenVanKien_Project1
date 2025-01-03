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
        Schema::create('NVK_QUANTRI', function (Blueprint $table) {
            $table->id();
            $table->string('nvkTaiKhoan', 255)->unique(); // Corrected unique() syntax
            $table->string('nvkMatKhau', 255);
            $table->tinyInteger('nvkTrangThai');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NVK_QUANTRI');
    }
};