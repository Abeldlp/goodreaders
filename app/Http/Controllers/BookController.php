<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBookRequest;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'author' => '',
            'buy_link' => '',
            'user_id' => ''
        ]);
        $imagePath = $request->image->store('uploads', 'public');
        $data = array_merge($validatedData, [
            'user_id' => Auth::id(),
            'image' => $imagePath
        ]);
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

        dd($request->title);
        $validatedData =  $request->validate(
            [
                'title' => 'required',
                'description' => '',
                'image' => 'required',
                'genre' => 'required',
                'buy_link' => '',
                'author' => '',
                'user_id' => ''
            ],
            [
                'title.required' => 'the title is required',
                'image.required' => 'the image is required',
                'genre.required' => 'the genre is required',
            ]
        );

        $data = array_merge($validatedData, ['user_id' => Auth::id()]);
        $book->update($data);
    }


    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $image_path = $book->image;
        Storage::delete('/public/'.$image_path);
        Book::destroy($book->id);
    }
}
