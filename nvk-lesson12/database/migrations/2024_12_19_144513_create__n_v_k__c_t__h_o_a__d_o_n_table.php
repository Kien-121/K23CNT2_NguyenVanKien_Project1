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
        Schema::create('NVK_CT_HOA_DON', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nvkHoaDonID')->references('id')->on('NVK_HOA_DON');
            $table->bigInteger('nvkSanPhamID')->references('id')->on('NVK_SAN_PHAM');
            $table->integer('nvkSoLuongMua');
            $table->float('nvkDonGiaMua');
            $table->float('nvkThanhTien');
            $table->tinyInteger('TranThai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NVK_CT_HOA_DON');
    }
};
