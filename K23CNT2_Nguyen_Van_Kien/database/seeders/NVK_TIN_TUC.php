<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class NVK_TIN_TUC extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Insert 10 rows of fake data into the 'NHT_TIN_TUC' table
        for ($i = 0; $i < 10; $i++) {
            DB::table('NVK_TIN_TUC')->insert([
                'nvkMaTT' => $faker->unique()->word, // Unique identifier for the news article
                'nvkTieuDe' => $faker->sentence, // Title of the news article
                'nvkMoTa' => $faker->text(200), // Description (shorter text)
                'nvkNoiDung' => $faker->paragraph(5), // Content (longer text)
                'nvkNgayDangTin' => $faker->dateTimeThisYear(), // Random date/time within the current year
                'nvkNgayCapNhap' => $faker->dateTimeThisYear(), // Random date/time within the current year
                'nvkHinhAnh' => $faker->imageUrl(), // Random image URL
                'nvkTrangThai' => $faker->numberBetween(0, 1), // Status (0 or 1, assuming binary status)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
