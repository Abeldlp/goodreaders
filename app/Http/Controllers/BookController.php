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
        $data = array_merge($validatedData, ['user_id' => Auth::id()]);
        (new Book())->create($data);
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
        $this->middleware('auth');
        //TO DOUBLE CHECK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $validatedData =  $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => 'required',
            'genre' => 'required',
            'buy_link' => '',
            'author' => '',
            'user_id' => ''
        ]);

        $book = Book::findOrFail($id);

        //$this->authorize('update', $book->id);
        //$book->update($validatedData);

        if(Auth::id() === $book->user_id){
            $data = array_merge($validatedData, ['user_id' => Auth::id()]);
            $book->update($data);
        } else {
            abort(403, 'Nope!');
        }

    }

    public function destroy($id)
    {
        Book::destroy($id);
    }
}
