<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Đảm bảo Hash được sử dụng

class NVK_KHACH_HANGTableSeeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('nvk_khach_hang')->insert([
            'nvkMaKhachHang'=>'KH001',
            'nvkHoTenKhachHang'=>'Vũ Quốc Khánh',
            'nvkEmail'=>'Khanh@gmail.com',
            'nvkMatKhau'=>Hash::make('123456a@'), // Mã hóa mật khẩu
            'nvkDienThoai'=>'01255003',
            'nvkDiaChi'=>'Hạ Long',
            'nvkNgayDangKy'=>'2024/12/12',
            'nvkTrangThai'=>0,
        ]);
        DB::table('nvk_khach_hang')->insert([
            'nvkMaKhachHang'=>'KH002',
            'nvkHoTenKhachHang'=>'Nguyễn Anh Tuấn',
            'nvkEmail'=>'Tuan@gmail.com',
            'nvkMatKhau'=>Hash::make('123456b#'), // Mã hóa mật khẩu
            'nvkDienThoai'=>'012554873',
            'nvkDiaChi'=>'Cẩm Phả - Quảng Ninh',
            'nvkNgayDangKy'=>'2025/01/01',
            'nvkTrangThai'=>0,
        ]);
    }
}
