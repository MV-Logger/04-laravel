<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{

    public static function getEntries(Book $book)
    {
        return Entry::where("book_id", $book->id)->get();
    }

    public static function addEntry(Request $request, Book $book)
    {
        self::validate($request);

        if ($request->fails()) {
            return response()->json($request->errors(), 400);
        }

        $entry = new Entry;

        $entry->book_id = $book->id;
        $entry->text = $request->text;
        $entry->when = $request->when;
        $entry->where = $request->where;
        $entry->save();
        return response(null, 201);
    }

    private static function validate(Request $request)
    {
        $request->validate([
            'text' => 'required|max:1000',
            'when' => 'required|max:100',
            'where' => 'required|max:100',
        ]);
    }
}
