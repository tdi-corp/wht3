<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $posts = [
            [
                'name' => 'Рама',
                'description' => 'Производство',
                'price' => 800,
                'url1' => 'https://test.com',                
            ],
        ];
        

        foreach($posts as $post) {
            DB::table('posts')->insert([
                'name' => $post['name'],
                'description' => $post['description'],
                'price' => $post['price'],
                'url1' => $post['url1'],
            ]);

        }

    }
}
