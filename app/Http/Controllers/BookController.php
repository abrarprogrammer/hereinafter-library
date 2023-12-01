<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $user = auth()->user();
        $publisher = $user->publisher;

        $book = Book::create($request->all());
        
        $authors = explode(',', $request->input('author_ids'));
        $book->authors()->attach($authors);

        $book->publisher()->attach($publisher);

        return response()->json(['success' => true, 'message' => 'Book created successfully'], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->all());

        return response()->json(['success' => true, 'message' => 'Book updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['success' => true, 'message' => 'Book deleted successfully'], 204);
    }
}
