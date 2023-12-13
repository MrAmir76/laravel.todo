<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TodoCommentsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'todo_id' => rand(1, 20),
            'content'=>$this->faker->text(),

        ];
    }
}
