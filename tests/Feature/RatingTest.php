<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_shouldCreateRating()
    {
        $this->withoutExceptionHandling();
        $user = (new User())->create([
            'name' => 'test_user',
            'email' => 'test_email@mail.com',
            'password' => 'test_pass'
        ]);

        $book = (new Book())->create([
            'title' => 'previous',
            'description' => 'test description',
            'image' => 'none',
            'genre' => 'horror',
            'buy_link' => 'test url',
            'user_id' => $user->id
        ]);

        $this->actingAs($user)->post('/api/rating', [
            'book_id' => $book->id,
            'score' => 5,
            'comment' => 'test_comment'
        ]);

        $this->assertDatabaseCount('ratings', 1);
    }
}
