<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
                'id' => 1,
                'name' => 'Рама',
                'description' => 'Производство',
                'price' => 800,
                'url1' => 'https://test.com',                
            ],
            [
                'name' => 'Рама',
                'description' => 'Производство',
                'price' => 500,
                'url1' => 'https://test.com',                
            ],
                        
        ];
        

        foreach($posts as $post) {
            DB::table('posts')->insert([
                'name' => $post['name'],
                'description' => $post['description'],
                'price' => $post['price'],
                'url1' => $post['url1'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }

    }
}
