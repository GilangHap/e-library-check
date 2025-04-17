<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Authors;
use App\Models\Book_publishers;
use App\Models\Book_types;
use App\Models\Book_categories;
use App\Models\Book_shelves;
use App\Models\Genres;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        // Pasangan ISBN dan OLID (OpenLibrary ID) yang valid
        $books = [
            ['isbn' => '9780439023528', 'olid' => 'OL22814336M', 'title' => 'The Hunger Games'],
            ['isbn' => '9780061120084', 'olid' => 'OL7826547M', 'title' => 'To Kill a Mockingbird'],
            ['isbn' => '9780141439518', 'olid' => 'OL8479903M', 'title' => 'Pride and Prejudice'],
            ['isbn' => '9780743273565', 'olid' => 'OL22570129M', 'title' => 'The Great Gatsby'],
            ['isbn' => '9780451524935', 'olid' => 'OL1407564M', 'title' => '1984'],
            ['isbn' => '9780316015844', 'olid' => 'OL17587333M', 'title' => 'Twilight'],
            ['isbn' => '9780307949486', 'olid' => 'OL25424364M', 'title' => 'The Girl with the Dragon Tattoo'],
            ['isbn' => '9780062315007', 'olid' => 'OL27321150M', 'title' => 'The Alchemist'],
            ['isbn' => '9780545010221', 'olid' => 'OL22856698M', 'title' => 'Harry Potter and the Deathly Hallows'],
            ['isbn' => '9780143105428', 'olid' => 'OL22521108M', 'title' => 'Brave New World'],
            ['isbn' => '9780679783268', 'olid' => 'OL1009468M', 'title' => 'The Catcher in the Rye'],
            ['isbn' => '9781451673319', 'olid' => 'OL25429123M', 'title' => 'Fahrenheit 451'],
            ['isbn' => '9781594480003', 'olid' => 'OL24382887M', 'title' => 'The Kite Runner'],
            ['isbn' => '9780393970128', 'olid' => 'OL7591622M', 'title' => 'Lord of the Flies'],
            ['isbn' => '9780385504201', 'olid' => 'OL3684783M', 'title' => 'The Da Vinci Code']
        ];

        // Pilih buku secara random
        $randomBook = $this->faker->unique()->randomElement($books);
        
        // Gunakan OLID untuk cover yang lebih andal
        $bookCover = "https://covers.openlibrary.org/b/olid/{$randomBook['olid']}-L.jpg";

        // Ambil real IDs dari database
        $authorId = Authors::pluck('id')->random();
        $publisherId = Book_publishers::pluck('id')->random();
        $genreId = Genres::pluck('id')->random();
        $typeId = Book_types::pluck('id')->random();
        $categoryId = Book_categories::pluck('id')->random();
        $shelfId = Book_shelves::pluck('id')->random();
        
        return [
            'title' => $randomBook['title'],
            'book_cover' => $bookCover,
            'quantity' => $this->faker->numberBetween(5, 30),
            'version' => $this->faker->numberBetween(1, 5),
            'language' => $this->faker->randomElement(['English', 'Indonesian', 'Japanese', 'Korean']),
            'author_id' => $authorId,
            'publisher_id' => $publisherId,
            'genre_id' => $genreId,
            'type_id' => $typeId,
            'category_id' => $categoryId,
            'shelf_id' => $shelfId,
            'publish_date' => $this->faker->dateTimeBetween('-20 years', 'now')->format('Y-m-d'),
            'isbn_issn' => $randomBook['isbn'],
            'pages' => $this->faker->numberBetween(150, 800),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
