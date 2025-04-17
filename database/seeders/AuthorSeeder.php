<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('authors')->insert([
            ['name' => 'J.K. Rowling'],
            ['name' => 'George R.R. Martin'],
            ['name' => 'J.R.R. Tolkien'],
        ]);
    }
}
