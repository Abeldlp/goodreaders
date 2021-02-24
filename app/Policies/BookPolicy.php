<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Book $book)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->user_id;
//            ? Response::allow()
//            : Response::deny('You don\'t own this book');
    }

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user_id
            ? Response::allow()
            : Response::deny('You don\'t own this book');
    }

    public function restore(User $user, Book $book)
    {
        //
    }

    public function forceDelete(User $user, Book $book)
    {
        //
    }
}
