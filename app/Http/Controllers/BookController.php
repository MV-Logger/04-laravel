<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public static function getBooks(int $userId)
    {
        return Book::where("user_id", $userId)->get();
    }

    public static function addBook(Request $request)
    {
        $book = new Book;

        $book->name = $request->name;
        $book->user_id = Auth::id();
        $book->save();
        return response(null, 201);
    }
}
