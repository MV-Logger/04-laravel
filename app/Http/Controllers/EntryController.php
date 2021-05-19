<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{

    public static function getEntries(int $bookId)
    {
        return Entry::where("book_id", $bookId)->get();
    }

    public static function addEntry(Request $request, int $bookId)
    {
        $entry = new Entry;

        $entry->book_id = $bookId;
        $entry->text = $request->text;
        $entry->when = $request->when;
        $entry->where = $request->where;
        $entry->save();
        return response(null, 201);
    }
}
