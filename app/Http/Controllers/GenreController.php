<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'style' => 'required|in:primary,secondary,success,danger,warning,info,light,dark',
        ]);

        Genre::create($validatedData);

        return redirect()->route('genreList')->with('success', 'Genre added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the genre data
        $genre = Genre::findOrFail($id);

        // Pass the genre data to the view
        return view('genres.edit', compact('genre'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Retrieve the genre
        $genre = Genre::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'style' => 'required|in:primary,secondary,success,danger,warning,info,light,dark',
        ]);

        // Update the genre with validated data
        $genre->update($validatedData);

        // Redirect back to genre list page
        return redirect()->route('genreList')->with('success', 'Genre updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the genre by its ID
        $genre = Genre::findOrFail($id);

        // Delete the genre
        $genre->delete();

        // Redirect back to the genre list page with a success message
        return redirect()->route('genreList')->with('success', 'Genre deleted successfully.');
    }

    /**
     * List books by genre.
     *
     * @param string $genreName The name of the genre to list books for.
     * @return \Illuminate\View\View Returns a view displaying books of a specific genre.
     */
    public function listByGenre($genreName)
    {
        // Retrieve the genre by name
        $genre = Genre::where('name', $genreName)->firstOrFail();
        // dd($genre);
        // Retrieve all books associated with the genre
        $books = $genre->books()->get();
        // dd($books);

        // Pass the genre and associated books to the view
        return view('books.listByGenre', ['genre' => $genre, 'books' => $books]);
    }
}
