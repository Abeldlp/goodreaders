<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{

    use RefreshDatabase;

    public function test_shouldFetchBooks()
    {
        Book::create([
            'title' => 'previous',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => 1
        ]);

        $response = $this->get('/api/books');
        $response->assertOk();
    }

    public function test_shouldSaveNewBook()
    {
        $this->post('/api/books/save', [
            'title' => 'test',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => 1
        ]);

        $this->assertDatabaseCount('books', 1);
    }

    public function test_shouldUpdateBook(){

        Book::create([
            'title' => 'previous',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => 1
        ]);

        $bookCreated = Book::all()->last();
        $this->assertEquals('previous', $bookCreated->title);


        $this->put('/api/books/'.$bookCreated->id, [
            'title' => 'changed',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => 1
        ]);

        $afterUpdate = Book::all()->last();
        $this->assertEquals('changed', $afterUpdate->title);
    }

    public function test_shouldShow1Book()
    {
        Book::create([
            'title' => 'previous',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => 1
        ]);

        $response = $this->get('/api/books/1');
        $response->assertOk();
    }

    public function test_shouldDeteleBook()
    {
        Book::create([
            'title' => 'book to delete',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => 1
        ]);
        $this->assertDatabaseCount('books', 1);

        $latestBook = Book::all()->last();

        $this->delete('/api/books/'.$latestBook->id);
        $this->assertDatabaseMissing('books', ['title' => 'book to delete']);
    }

}
