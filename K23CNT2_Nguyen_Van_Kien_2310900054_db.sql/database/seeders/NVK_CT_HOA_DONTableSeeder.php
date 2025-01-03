<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NVK_CT_HOA_DONTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // //
        DB::table('NVK_CT_HOA_DON')->insert([
            'nvkHoaDonID'=>1,
            'nvkSanPhamID'=>1,
            'nvkSoLuongMua'=>12,
            'nvkDonGiaMua'=>699000,
            'nvkThanhTien'=>699000 * 12,
            'nvkTrangThai'=>0,
        ]);

        DB::table('NVK_CT_HOA_DON')->insert([
            'nvkHoaDonID'=>2,
            'nvkSanPhamID'=>2,
            'nvkSoLuongMua'=>20,
            'nvkDonGiaMua'=>550000,
            'nvkThanhTien'=>550000 * 20,
            'nvkTrangThai'=>0,
        ]);
    }
}
