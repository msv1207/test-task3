<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(10)->create();
        Admin::factory(10)->create();

        Author::factory(10)->create()->each(fn(Author $author) => $author
            ->books()
            ->createMany(Book::factory(10)->make()->toArray())
        );
    }
}
