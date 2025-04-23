<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Zeugnis Zauberer',
            'email' => 'zauberer@bsiag.com',
            'password' => Hash::make('test1234'),
            'apprentice_start' => Carbon::parse("2022-08-01")
        ]);
    }
}
