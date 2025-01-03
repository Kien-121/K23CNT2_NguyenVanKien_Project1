<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class  NVK_LOAI_SAN_PHAMTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L001",
            'nvkTenLoai'=>"Chó ",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L002",
            'nvkTenLoai'=>"Mèo ",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L003",
            'nvkTenLoai'=>"Chim ",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L004",
            'nvkTenLoai'=>"Cá ",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L005",
            'nvkTenLoai'=>"Gà ",
            'nvkTrangThai'=>0
        ]);
    }
}