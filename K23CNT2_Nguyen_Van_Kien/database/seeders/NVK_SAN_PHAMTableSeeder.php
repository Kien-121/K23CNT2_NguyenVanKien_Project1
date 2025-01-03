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
            'nvkTenSanPham'=> "Lexus es 250",
            'nvkHinhAnh'=>"img/san_pham/SP001.jpg",
            'nvkSoLuong'=>100,
            'nvkDonGia'=>699000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
        DB::table("nvk_san_pham")->insert([
            'nvkMaSanPham'=>"SP001",
            'nvkTenSanPham'=> "Rolls-Royce Ghost",
            'nvkHinhAnh'=>"img/san_pham/SP002.jpg",
            'nvkSoLuong'=>200,
            'nvkDonGia'=>550000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
        DB::table("nvk_san_pham")->insert([
            'nvkMaSanPham'=> "SP003",
            'nvkTenSanPham'=> "Continental GT",
            'nvkHinhAnh'=>"img/san_pham/SP003.jpg",
            'nvkSoLuong'=>150,
            'nvkDonGia'=>250000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
        DB::table("nvk_san_pham")->insert([
            'nvkMaSanPham'=> "VP004",
            'nvkTenSanPham'=> "Audi Q5",
            'nvkHinhAnh'=>"img/san_pham/SP003.jpg",
            'nvkSoLuong'=>300,
            'nvkDonGia'=>799000,
            'nvkMaLoai'=>1,
            'nvkTrangThai'=>0
        ]);
    }
}
