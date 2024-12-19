<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class NVK_LOAI_SAN_PHAMTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('NVK_LOAI_SAN_PHAM')->insert([
            'nvkMaLoai' => "L001",
            'nvkTenLoai' =>"Cây cảnh văn phòng",
            'nvkTranThai' =>0
        ]);
        DB::table('NVK_LOAI_SAN_PHAM')->insert([
            'nvkMaLoai' => "L002",
            'nvkTenLoai' =>"Cây cảnh phong thủy",
            'nvkTranThai' =>0
        ]);
        DB::table('NVK_LOAI_SAN_PHAM')->insert([
            'nvkMaLoai' => "L003",
            'nvkTenLoai' =>"Cây để bàn",
            'nvkTranThai' =>0
        ]);
        DB::table('NVK_LOAI_SAN_PHAM')->insert([
            'nvkMaLoai' => "L004",
            'nvkTenLoai' =>"Cây thủy canh",
            'nvkTranThai' =>0
        ]);
    }
}
