<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookPublisherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('book_publishers')->insert([
            ['name' => 'Penguin Random House'],
            ['name' => 'HarperCollins'],
            ['name' => 'Simon & Schuster'],
        ]);
    }
}
