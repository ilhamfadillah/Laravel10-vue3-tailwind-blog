<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('likes')->truncate();
        DB::table('blogs')->truncate();
        DB::table('users')->truncate();

        for ($i=0; $i < 3; $i++) {
            $admin = User::factory()
                ->has(Blog::factory()->count(10))
                ->create([
                    'name' => fake()->name(),
                    'role' => 'admin',
                    'email' => 'admin' . ($i == 0 ? "" : $i) . '@admin.com',
                    'password' => bcrypt('password')
                ]);
        }

        for ($i=0; $i < 10; $i++) {
            $user = User::factory()
                ->has(Blog::factory()->count(10))
                ->create([
                    'name' => fake()->name(),
                    'role' => 'user',
                    'email' => 'testing' . ($i == 0 ? "" : $i) . '@testing.com',
                    'password' => bcrypt('password')
                ]);
        }

        $users = User::get();
        foreach ($users as $user) {
            $blogs = Blog::where("user_id", "!=", $user->_id)->inRandomOrder(30)->get();
            foreach ($blogs as $blog) {
                $user->likes()->attach($blog, ['is_like' => (bool)mt_rand(0, 1)]);
            }
        }
    }
}
