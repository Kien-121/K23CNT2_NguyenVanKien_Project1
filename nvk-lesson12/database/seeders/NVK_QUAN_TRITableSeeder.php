<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NVK_QUAN_TRITableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nvkMatKhau = md5("123456a@");
        DB::table('NVK_QUAN_TRI')->insert([
            'nvkTaiKhoan'=>"vankien@gmail.com",
            'nvkMatKhau' => $nvkMatKhau,
            'nvkTranThai'=>0
       ]);
        DB::table('NVK_QUAN_TRI')->insert([
            'nvkTaiKhoan'=>"0987654321",
            'nvkMatKhau' => $nvkMatKhau,
            'nvkTranThai'=>0
       ]);
    }
}
