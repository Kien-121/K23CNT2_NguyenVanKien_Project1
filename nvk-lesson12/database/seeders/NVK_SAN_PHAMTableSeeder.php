<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NVK_SAN_PHAMTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "VP001",
            'nvkTenSanPham'   => "Cây phú quý",
            'nvkHinhAnh'   => "image/san-pham/VP001.jdg",
            'nvkSoLuong'   => 100,
            'nvkDonGia'   => 600000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "VP002",
            'nvkTenSanPham'   => "Cây phú gia",
            'nvkHinhAnh'   => "image/san-pham/VP002.jdg",
            'nvkSoLuong'   => 200,
            'nvkDonGia'   => 699000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "VP003",
            'nvkTenSanPham'   => "Cây vui vẻ",
            'nvkHinhAnh'   => "image/san-pham/VP003.jdg",
            'nvkSoLuong'   => 100,
            'nvkDonGia'   => 900000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "VP004",
            'nvkTenSanPham'   => "Cây trường sinh",
            'nvkHinhAnh'   => "image/san-pham/VP004.jdg",
            'nvkSoLuong'   => 170,
            'nvkDonGia'   => 199000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "TP001",
            'nvkTenSanPham'   => "Cây đại cát",
            'nvkHinhAnh'   => "image/san-pham/TP001.jdg",
            'nvkSoLuong'   => 1220,
            'nvkDonGia'   => 609000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "TP002",
            'nvkTenSanPham'   => "Cây đại thụ",
            'nvkHinhAnh'   => "image/san-pham/TP002.jdg",
            'nvkSoLuong'   => 90,
            'nvkDonGia'   => 109000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "TP003",
            'nvkTenSanPham'   => "Cây phú gia",
            'nvkHinhAnh'   => "image/san-pham/TP003.jdg",
            'nvkSoLuong'   => 100,
            'nvkDonGia'   => 600000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
        DB::table("NVK_SAN_PHAM")->insert([
            'nvkMaSanPham'   => "TP004",
            'nvkTenSanPham'   => "Cây Mai",
            'nvkHinhAnh'   => "image/san-pham/TP004.jdg",
            'nvkSoLuong'   => 100,
            'nvkDonGia'   => 600000,
            'nvkMaLoai'   =>1,
            'nvkTranThai'   =>0,
        ]);
    }
}
