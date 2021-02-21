<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SpaController extends Controller
{
    public function index()
    {
        $auth_user = Auth::user() ?? '';
        return view('spa', compact(
            'auth_user'
        ));
    }
}
