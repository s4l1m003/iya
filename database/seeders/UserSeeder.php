<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $users = [
            ['name' => 'Admin', 'email' => 'admin@example.test', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['name' => 'Marketing One', 'email' => 'marketing@example.test', 'password' => Hash::make('password'), 'role' => 'marketing'],
            ['name' => 'Pajak', 'email' => 'pajak@example.test', 'password' => Hash::make('password'), 'role' => 'pajak'],
            ['name' => 'Ketua', 'email' => 'ketua@example.test', 'password' => Hash::make('password'), 'role' => 'ketua'],
            ['name' => 'Pelanggan', 'email' => 'pelanggan@example.test', 'password' => Hash::make('password'), 'role' => 'pelanggan'],
        ];

        foreach ($users as $u) {
            DB::table('users')->updateOrInsert(
                ['email' => $u['email']],
                array_merge($u, ['created_at' => $now, 'updated_at' => $now])
            );
        }
    }
}