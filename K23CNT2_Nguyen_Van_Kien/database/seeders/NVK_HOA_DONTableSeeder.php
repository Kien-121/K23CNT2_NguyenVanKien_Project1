<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NVK_HOA_DONTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('nvk_hoa_don')->insert([
            'nvkMaHoaDon'=>'HD001',
            'nvkMaKhachHang'=>1,
            'nvkNgayHoaDon'=>'2024/12/12',
            'nvkNgayNhan'=>'2024/12/12',
            'nvkHoTenKhachHang'=>'Vũ Quốc Khánh',
            'nvkEmail'=>'Khanh@gmail.com',
            'nvkDienThoai'=>'01255003',
            'nvkDiaChi'=>'Hạ Long',
            'nvkTongGiaTri'=>'790000',
            'nvkTrangThai'=>2,
        ]);

        DB::table('nvk_hoa_don')->insert([
            'nvkMaHoaDon'=>'HD002',
            'nvkMaKhachHang'=>2,
            'nvkNgayHoaDon'=>'2025-01-03',
            'nvkNgayNhan'=>'2024/01/04',
            'nvkHoTenKhachHang'=>'Nguyễn Vinh Tuấn',
            'nvkEmail'=>'tuan@gmail.com',
            'nvkDienThoai'=>'056894848',
            'nvkDiaChi'=>'Cẩm Phả _ Quảng Ninh',
            'nvkTongGiaTri'=>'125000',
            'nvkTrangThai'=>0,
        ]);
    }
}
