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
            'nvkTenLoai'=>"Hãng Xe Lexus",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L002",
            'nvkTenLoai'=>"Hãng Rolls-Royce ",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L003",
            'nvkTenLoai'=>"Hãng Bentley",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L004",
            'nvkTenLoai'=>"Hãng xe BMW",
            'nvkTrangThai'=>0
        ]);
        DB::table('nvk_loai_san_pham')->insert([
            'nvkMaLoai'=> "L005",
            'nvkTenLoai'=>"Hãng Audi",
            'nvkTrangThai'=>0
        ]);
    }
}