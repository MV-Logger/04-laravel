<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Entry;
use Illuminate\Http\Request;
use Validator;

class EntryController extends Controller
{

    public static function getEntries(Book $book)
    {
        return Entry::where("book_id", $book->id)->get();
    }

    public static function addEntry(Request $request, Book $book)
    {

        $validated = Validator::make($request->all(), [
            'text' => 'required|max:1000',
            'when' => 'required|max:100',
            'where' => 'required|max:100',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $entry = new Entry;

        $entry->book_id = $book->id;
        $entry->text = $request->text;
        $entry->when = $request->when;
        $entry->where = $request->where;
        $entry->save();
        return response(null, 201);
    }
}
