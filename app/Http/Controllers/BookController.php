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
        return Book::with('user')->with('score')->get();
    }

    public function store(SaveBookRequest $request)
    {
        $validatedData =  $this->validate($request, $request->messages());

        (new Book())->create($validatedData);
    }

    public function show($id)
    {
        return [
            'book' => Book::find($id),
            'ratings' => Rating::where('book_id', $id)->with('user')->with('replies')->get()
        ];
    }

    public function update(SaveBookRequest $request, $id)
    {
        $validatedData = $this->validate($request, $request->messages());

        (new Book())::find($id)->update($validatedData);
    }

    public function destroy($id)
    {
        Book::destroy($id);
    }
}
