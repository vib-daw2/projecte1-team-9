<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Symfony\Component\String\b;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {

            $username = Str::random(10);

            DB::table('users')->insert([
                'username' => $username,
                'email' => $username . '@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
            ]);

            $id = DB::table('users')->where('username', $username)->first()->id;

            for ($j = 0; $j < 10; $j++) {
                $blog = new Blog();
                $blog->title = Str::random(10);
                $blog->subtitle = Str::random(10);

                $paragraphs = rand(1, 10);
                $body = '';
                for ($k = 0; $k < $paragraphs; $k++) {
                    for ($l = 0; $l < rand(20,50); $l++) {
                        $body .= Str::random(rand(3, 10)) . ' ';
                    }
                    $body .= "\n\n";
                }

                $blog->body = $body;
                $blog->user_id = $id;
                $blog->status = 'published';
                $blog->views = rand(0, 10000000);
                $blog->save();
            }
        }
    }
}
