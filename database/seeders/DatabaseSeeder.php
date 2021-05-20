<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Entry;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Book::factory(10)->create();
        Entry::factory(10)->create();
    }
}
