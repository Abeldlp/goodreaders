<?php

namespace Tests\Feature;

use App\Models\Book;
use Database\Factories\UserFactory;
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
        $user = UserFactory::new()->create();
        $this->actingAs($user)->post('/api/books/save', [
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

        $this->withoutExceptionHandling();
        $user = UserFactory::new()->create();

        $this->actingAs($user)->post('/api/books/save', [
            'title' => 'previous',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => $user->id,
        ]);

        $bookCreated = Book::all()->last();

        $this->actingAs($user)->put('/api/books/'.$bookCreated->id, [
            'title' => 'changed',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => $user->id
        ]);

        $bookUpdated = Book::all()->last();
        $this->assertEquals('changed', $bookUpdated->title);
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
        $this->withoutExceptionHandling();
        $user1 = UserFactory::new()->create();

        $this->actingAs($user1)->post('/api/books/save', [
            'title' => 'book to delete',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => $user1->id,
        ]);

        $this->assertDatabaseCount('books', 1);

        $latestBook = Book::all()->last();

        $this->actingAs($user1)->delete('/api/books/'.$latestBook->id);
        $this->assertDatabaseMissing('books', ['title' => 'book to delete']);
    }

    /** @test */
    public function it_should_deny_update_to_other_user()
    {
        $user1 = UserFactory::new()->create();

        $this->actingAs($user1)->post('/api/books/save', [
            'title' => 'test',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => $user1->id,
        ]);

        $lastBookCreated = Book::all()->last();

        $user2 = UserFactory::new()->create();

        $response = $this->actingAs($user2)->put('/api/books/'.$lastBookCreated->id, [
            'title' => 'changed',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'author' => 'test_author',
            'user_id' => 1
        ]);

        $response->assertForbidden();
    }

}
