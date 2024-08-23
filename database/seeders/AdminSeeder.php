<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserEnum;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            UserEnum::NAME => 'Super Admin',
            UserEnum::EMAIL => 'super@admin.com',
            UserEnum::PHONE => '01620128405',
            UserEnum::PASSWORD => Hash::make('12345678'),
            UserEnum::STATUS => UserEnum::STATUS_ACTIVE,
            UserEnum::ROLE => UserEnum::ROLE_ADMIN,
        ]);
    }
}
