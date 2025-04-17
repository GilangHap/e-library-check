<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('book_cover');
            $table->text('description');
            $table->date('publish_date');
            $table->integer('version');
            $table->string('isbn_issn');
            $table->integer('quantity');
            $table->string('language');
            $table->integer('pages');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('shelf_id');
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('type_id');

            //foreign keys
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('book_categories')->onDelete('cascade');
            $table->foreign('shelf_id')->references('id')->on('book_shelves')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('book_publishers')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('book_types')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books'); // Added dropIfExists for proper rollback
    }
};
