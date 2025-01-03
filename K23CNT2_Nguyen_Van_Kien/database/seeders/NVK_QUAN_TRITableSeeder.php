<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Thêm dòng này

class NVK_QUAN_TRITableSeeder extends Seeder
{
    public function run(): void
    {
         // Kiểm tra xem email đã tồn tại hay chưa
    $exists = DB::table('NVK_QUAN_TRI')->where('nvkTaiKhoan', 'nvk@gmail.com')->exists();
    if (!$exists) {
        DB::table('NVK_QUAN_TRI')->insert([
            'nvkTaiKhoan' => 'nvk@gmail.com',
            'nvkMatKhau' => Hash::make('123'), // Đảm bảo mật khẩu được mã hóa
            'nvkTrangThai' => 0,
        ]);
        DB::table('NHT_QUAN_TRI')->insert([
            'nvkTaiKhoan'=>"0123456",
            'nvkMatKhau'=>Hash::make('123'), // Đảm bảo mật khẩu được mã hóa
            'nvkTrangThai'=>0
        ]);
                 }
    }
}
