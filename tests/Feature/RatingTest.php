<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Rating;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_shouldCreateRating()
    {
        $user = UserFactory::new()->create();

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

    public function test_shouldUpdateRating()
    {
        $user = UserFactory::new()->create();

        $this->actingAs($user)->post('/api/rating/', [
            'book_id' => 1,
            'score' => 5,
            'comment' => 'Best book ever!'
        ]);

        $created = Rating::all()->last();

        $this->assertDatabaseCount('ratings', 1);

        $this->actingAs($user)->put('/api/rating/'.$created->id, [
            'book_id' => 1,
            'score' => 3,
            'comment' => 'Best book ever!'
        ]);

        $lastRating = Rating::all()->last();

        $this->assertEquals(3, $lastRating->score);
    }

    public function test_shouldDeleteRating()
    {
        $user = UserFactory::new()->create();

        $this->actingAs($user)->post('/api/rating',[
            'book_id' => 30,
            'score' => 3,
            'comment' => 'Best book ever!'
        ]);

        $this->assertDatabaseHas('ratings', ['book_id' => 30]);
        $createdRating = Rating::all()->last();

        $this->actingAs($user)->delete('/api/rating/' . $createdRating->id);

        $this->assertDatabaseMissing('ratings', ['book_id' => 30]);
    }
}
