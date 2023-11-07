<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // dijalankan saat run class StudentSeeder
    {
        $data = [
            ['id' => 1, 'name'=> 'Aisyah', 'score'=> 93],
            ['id' => 2, 'name'=> 'Aiden', 'score'=> 89],
            ['id' => 3, 'name'=> 'Jay', 'score'=> 90]
        ];

        DB::table('students')->insert($data);
    }
}
