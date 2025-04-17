<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BookCategorySeeder;
use Database\Seeders\BookShelfSeeder;
use Database\Seeders\BookPublisherSeeder;
use Database\Seeders\GenreSeeder;
use Database\Seeders\BookTypeSeeder;
use Database\Seeders\AuthorSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(15)->create();
        
        // Call seeders for reference tables first
        $this->call([
            BookCategorySeeder::class,
            BookShelfSeeder::class,
            BookPublisherSeeder::class,
            GenreSeeder::class,
            BookTypeSeeder::class,
            AuthorSeeder::class,
        ]);
        
        // Create books after all related tables are populated
        Books::factory(15)->create();
    }
}
