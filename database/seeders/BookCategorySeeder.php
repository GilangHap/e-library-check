<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('book_categories')->insert([
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science'],
            ['name' => 'History'],
        ]);
    }
}
