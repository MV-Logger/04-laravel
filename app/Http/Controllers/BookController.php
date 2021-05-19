<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public static function getBooks()
    {
        return Book::where("user_id", Auth::id())->get();
    }

    public static function addBook(Request $request)
    {
        self::validate($request);

        if ($request->fails()) {
            return response()->json($request->errors(), 400);
        }

        $book = new Book;
        $book->name = $request->name;
        $book->user_id = Auth::id();
        $book->save();
        return response(null, 201);
    }

    private static function validate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100'
        ]);
    }
}
