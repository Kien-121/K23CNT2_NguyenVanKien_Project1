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
        DB::table("nvk_san_pham")->insert([
            'nvkMaSanPham'=> "SP001",
            'nvkTenSanPham'=> "Mèo Nhật ",
            'nvkHinhAnh'=>"image/meonhat.jpg",
            'nvkSoLuong'=>100,
            'nvkDonGia'=>699000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
        DB::table("nvk_san_pham")->insert([
            'nvkMaSanPham'=>"SP002",
            'nvkTenSanPham'=> "Chó cảnh ",
            'nvkHinhAnh'=>"image/chocanh.jpg",
            'nvkSoLuong'=>200,
            'nvkDonGia'=>550000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
        DB::table("nvk_san_pham")->insert([
            'nvkMaSanPham'=> "SP003",
            'nvkTenSanPham'=> "Gà rừng ",
            'nvkHinhAnh'=>"image/garung.jpg",
            'nvkSoLuong'=>150,
            'nvkDonGia'=>250000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
        DB::table("nvk_san_pham")->insert([
            'nvkMaSanPham'=> "VP004",
            'nvkTenSanPham'=> "Cá cảnh ",
            'nvkHinhAnh'=>"image/cacanh.jpg",
            'nvkSoLuong'=>300,
            'nvkDonGia'=>799000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
    }
}
