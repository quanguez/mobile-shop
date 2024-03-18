<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(public_path('json\users.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $record = User::where('email', $item['email'])->first();
            if ($record) {
                return;
            } else {
                User::query()->create([
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'email_verified_at' => now(),
                    'password' => $item['password'],
                    'remember_token' => $item['remember_token'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
