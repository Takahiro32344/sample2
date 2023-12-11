<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Bullentin_BoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Tokyo');

        for ($i = 1; $i <= 40; $i++) {
            DB::table('bullentin_board')->insert([
                'user_id' => $i,
                'text' => '宜しくお願いします',
                'date' => date("Y/m/d G:i:s"),
                'created_at' => date("Y/m/d G:i:s"),
                'updated_at' => date("Y/m/d G:i:s")
            ]);
        }
    }
}
