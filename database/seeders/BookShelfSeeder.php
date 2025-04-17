<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookShelfSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('book_shelves')->insert([
            ['name' => 'Shelf A'],
            ['name' => 'Shelf B'],
            ['name' => 'Shelf C'],
        ]);
    }
}
