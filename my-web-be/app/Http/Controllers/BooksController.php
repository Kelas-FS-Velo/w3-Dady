<?php

namespace App\Http\Controllers;

use App\Models\BooksModel;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index()
    {
        $books = BooksModel::all();
        return response()->json($books);
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' => 'required|string|unique:books',
            'category' => 'nullable|string',
            'published_year' => 'nullable|integer|min:1000|max:9999',
            'stock' => 'integer|min:0'
        ]);

        $book = BooksModel::create($request->all());

        return response()->json($book, 201);
    }

    /**
     * Display the specified book.
     */
    public function show($id)
    {
        $book = BooksModel::findOrFail($id);
        return response()->json($book);
    }

    /**
     * Update the specified book.
     */
    public function update(Request $request, $id)
    {
        $book = BooksModel::findOrFail($id);

        $request->validate([
            'title' => 'string',
            'author' => 'string',
            'isbn' => 'string|unique:books,isbn,' . $id,
            'category' => 'nullable|string',
            'published_year' => 'nullable|integer|min:1000|max:9999',
            'stock' => 'integer|min:0'
        ]);

        $book->update($request->all());

        return response()->json($book);
    }

    /**
     * Remove the specified book.
     */
    public function destroy($id)
    {
        $book = BooksModel::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
