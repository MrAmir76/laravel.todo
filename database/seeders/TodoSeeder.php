<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{

    public function run()
    {
        Todo::factory(20)->create();
    }
}
