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
        Schema::create('NVK_HOA_DON', function (Blueprint $table) {
            $table->id();
            $table->string('nvkMaHoaDon',255)->unique();
            $table->bigInteger('nvkMaKhachhang')->references('id')->on('NVK_KHACH_HANG');
            $table->date('nvkNgayHoaDon');
            $table->string('nvkHoTenKhachHang',255);
            $table->string('nvkEmail',255);
            $table->string('nvkDienThoai',255);
            $table->string('nvkDiaChi',255);
            $table->float('nvkTongTriGia');
            $table->string('nvkTranThai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NVK_HOA_DON');
    }
};
