<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokenSeeder extends Seeder
{

    public function run()
    {
        $tokenData = [
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => '1',
            'name' => 'admin@gmail.com',
            'token' => '148a01207f19e210acf9f25f9fbf7d97fd970c6dc0d1b3a0c368c08da854873a',
            'abilities' => '["*"]',
            'created_at' => now('Asia/Tehran'),
            'updated_at' => now('Asia/Tehran'),
        ];
        DB::table('personal_access_tokens')->insert($tokenData);
    }
}
