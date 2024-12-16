<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NvkVattuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('nvkvattu')->insert([
            'nvkMaVTu'=>'DD01',
            'nvkTenVTu'=>'Dau DVD 1cua',
            'nvkDvTinh'=>'Bo',
            'nvkPhanTram'=>40,
        ]);
        DB::table('nvkvattu')->insert([
            'nvkMaVTu'=>'DD01',
            'nvkTenVTu'=>'Dau DVD 1cua',
            'nvkDvTinh'=>'Bo',
            'nvkPhanTram'=>40,
        ]);
    }
}
