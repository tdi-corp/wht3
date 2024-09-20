<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
 
    public function definition(): array
    {
        return [
            'id' => rand(2, 1000),
            'name' => Str::random(10),
            'description' => fake()->name(),
            'price' => rand(5, 500),
            'url1' => Str::random(10),                
        ];
    }

}
