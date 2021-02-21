<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rating_id' => 'integer|required',
            'user_id' => '',
            'reply' => 'string|required'
        ]);

        $withUserId = array_merge($validatedData, ['user_id' => Auth::id()]);

        (new Rating())->create($withUserId);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'rating_id' => 'integer|required',
            'user_id' => '',
            'reply' => 'string|required'
        ]);

        $withUserId = array_merge($validatedData, ['user_id' => Auth::id()]);

        (new Rating())->find($id)->update($withUserId);
    }

    public function destroy($id)
    {
        (new Rating())->destroy($id);
    }
}
