<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $current_page = 1;
        $previous_page = 0;
        $next_page = 2;

        if($request->has('page')) {
            $current_page = $request->get('page');
            $previous_page = $current_page - 1;
            $next_page = $current_page + 1;
        }

        $publishers = Publisher::with('books')->get();

        $books = $publishers->flatMap(function ($publisher) {
            return $publisher->books->map(function ($book) use ($publisher) {
                $book->publisher_name = $publisher->name;
                return $book;
            });
        })->filter();

        $perPage = 10;
        $offset = ($current_page - 1) * $perPage;

        $books = $books->slice($offset, $perPage);

        return view('home', compact('books', 'previous_page', 'next_page'));
    }
}
