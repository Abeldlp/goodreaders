<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'integer',
            'user_id' => Auth::id(),
            'score' => 'integer|required',
            'comment' => 'string'
        ]);

        (new Rating())->create($validatedData);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'book_id' => 'integer',
            'user_id' => Auth::id(),
            'score' => 'integer|required',
            'comment' => 'string'
        ]);

        (new Rating())->find($id)->update($validatedData);
    }

    public function destroy($id)
    {
        (new Rating())->destroy($id);
    }
}
