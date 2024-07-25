<?php

namespace Database\Seeders;

use App\Models\random_string;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RandStringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        random_string::create([
            'rand_strings' => 'cajtdbatogkstajhdf'
        ]);
    }
}
