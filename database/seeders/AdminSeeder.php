<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'first_name'=> 'Zadanie',
            'last_name' => 'Rekrutacyjne',
            'email' => 'zadanie@rekrutacyjne.pl',
            'password' =>bcrypt('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'pesel' => '11111111111',
            'is_admin' => true,
            'is_active' => true,
            'from' => 'CLI'
        ]);
             
    }
}
