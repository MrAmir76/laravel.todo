<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class TodoFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->text(50),
            'content' => $this->faker->text(),
            'deadline' => rand(1, 20),
            'user_id' => 1,
            'result' => $this->faker->text(),
            'finally_result' => $this->faker->text(),
            'finally_status' => rand(0, 1)


        ];
    }
}
