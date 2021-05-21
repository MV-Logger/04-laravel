<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class BookController extends Controller
{

    public static function getBooks()
    {
        return Book::where("user_id", Auth::id())->get();
    }

    public static function addBook(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required|max:100'
        ]);

        if ($validated ->fails()) {
            return response()->json($request->errors(), 400);
        }

        $book = new Book;
        $book->name = $request->name;
        $book->user_id = Auth::id();
        $book->save();

        return response(null, 201);
    }

    public static function getBook(Book $book): Book
    {
        return $book;
    }

    public static function deleteBook(Book $book)
    {
        $book->delete();
    }

    public static function updateBook(Book $book, Request $request)
    {
        $request->validate([
            "name" => "required|max:100"
        ]);

        if ($request->fails()) {
            return response()->json($request->errors(), 400);
        }

        $book->name = $request->name;
        $book->save();
    }
}
