<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function getBooks(Request $request)
    {
        $current_page = $request->query->get('page', 1);

        $publishers = Publisher::with('books')->get();

        $books = $publishers->flatMap(function ($publisher) {
            return $publisher->books->map(function ($book) use ($publisher) {
                $book->publisher_name = $publisher->name;
                $book->authors;
                return $book;
            });
        })->filter();

        $total = $books->count();

        $perPage = 4;
        $offset = ($current_page - 1) * $perPage;

        $books = $books->slice($offset, $perPage);

        $last = ($offset + $books->count()) >= $total;

        return response()->json(['books' => $books, 'last' => $last]);
    }

}
