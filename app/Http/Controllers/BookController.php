<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBookRequest;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('user')->with('ratings')->get();
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => 'required',
            'genre' => 'required',
            'author' => '',
            'buy_link' => '',
            'user_id' => ''
        ]);
        $data = array_merge($validatedData, ['user_id' => Auth::id()]);
        (new Book())->create($data);
    }

    public function show(Book $book)
    {
        return [
            'book' => $book,
            'ratings' => Rating::where('book_id', $book->id)->with('user')->with('replies')->get()
        ];
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $validatedData =  $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => 'required',
            'genre' => 'required',
            'buy_link' => '',
            'author' => '',
            'user_id' => ''
        ]);

        $data = array_merge($validatedData, ['user_id' => Auth::id()]);
        $book->update($data);
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        Book::destroy($book->id);
    }
}
