<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBookRequest;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('user')->with('ratings')->get();
    }

    public function store(Request $request)
    {
        //DOUBLE CHECK IF THIS VALIDATION WORKS
        //$validatedData =  $this->validate($request, $request->messages());
        $validatedData =  $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => 'required',
            'genre' => 'required',
            'buy_link' => '',
            'user_id' => 'integer'
        ]);

        (new Book())->create($validatedData);
    }

    public function show($id)
    {
        return [
            'book' => Book::find($id),
            'ratings' => Rating::where('book_id', $id)->with('user')->with('replies')->get()
        ];
    }

    public function update(Request $request, $id)
    {
        //DOUBLE CHECK IF THIS VALIDATION WORKS
        //$validatedData = $this->validate($request, $request->messages());
        $validatedData =  $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => 'required',
            'genre' => 'required',
            'buy_link' => '',
            'user_id' => 'integer'
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);
    }

    public function destroy($id)
    {
        Book::destroy($id);
    }
}
