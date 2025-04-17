<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('book_types')->insert([
            ['name' => 'Hardcover'],
            ['name' => 'Paperback'],
            ['name' => 'Ebook'],
        ]);
    }
}
