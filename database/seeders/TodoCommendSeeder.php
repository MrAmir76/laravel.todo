<?php

namespace Database\Seeders;

use App\Models\TodoComments;
use Illuminate\Database\Seeder;

class TodoCommendSeeder extends Seeder
{
    public function run()
    {
        TodoComments::factory(50)->create();
    }
}
