<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCount = User::count();
        $bookCount = Book::count();
        $genreCount = Genre::count();
        $activeRentals = Borrow::where('status', "ACCEPTED")->count();
        $genres = Genre::all();

        return view('main', compact('userCount', 'bookCount', 'genreCount', 'activeRentals', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'released_at' => 'required|date|before:now',
            'pages' => 'required|integer|min:1',
            'isbn' => 'required|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',
            'description' => 'nullable',
            'genres' => 'required|array',
            'in_stock' => 'required|integer|min:0',
        ]);

        // Create the book
        $book = Book::create($validatedData);

        // Attach selected genres to the book
        $book->genres()->attach($request->input('genres'));

        // Redirect back to main page
        return redirect()->route('main')->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('genres')->findOrFail($id);

        // Check if the user has an ongoing rental process for this book
        $ongoingRental = auth()->check() ? Borrow::where('book_id', $id)
            ->where('reader_id', auth()->id())
            ->where('status', '!=', 'RETURNED')
            ->exists() : false;

        return view('books.bookDetail', ['book' => $book, 'ongoingRental' => $ongoingRental]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $genres = Genre::all();
        return view('books.edit', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the book
        $book = Book::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'released_at' => 'required|date|before:now',
            'pages' => 'required|integer|min:1',
            'isbn' => 'required|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',
            'description' => 'nullable',
            'genres' => 'required|array',
            'in_stock' => 'required|integer|min:0',
        ]);

        // Update the book attributes
        $book->title = $validatedData['title'];
        $book->authors = $validatedData['authors'];
        $book->released_at = $validatedData['released_at'];
        $book->pages = $validatedData['pages'];
        $book->isbn = $validatedData['isbn'];
        $book->description = $validatedData['description'];
        $book->in_stock = $validatedData['in_stock'];

        // Sync the genres
        $book->genres()->sync($validatedData['genres']);

        // Save the changes
        $book->save();

        // Redirect back to book details page
        return redirect()->route('bookDetails', $book->id)->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the book
        $book = Book::findOrFail($id);

        // Delete the book
        $book->delete();

        // Redirect back to main page
        return redirect()->route('main')->with('success', 'Book deleted successfully!');
    }

    /**
     * Search for a book.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::whereRaw('LOWER(title) LIKE ?', ["%" . strtolower($query) . "%"])
            ->orWhereRaw('LOWER(authors) LIKE ?', ["%" . strtolower($query) . "%"])
            ->get();


        return view('books.searchResults', compact('books'));
    }

    /**
     * Borrow a book for readers!
     */
    public function borrowBook(Request $request, $bookId)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            // Redirect unauthenticated users to the login page
            return redirect()->route('login')->with('error', 'You need to login to borrow a book.');
        }

        // Check if the user already has an ongoing rental process for the selected book
        $existingRental = Borrow::where('reader_id', auth()->id())
            ->where('book_id', $bookId)
            ->whereIn('status', ['PENDING', 'ACCEPTED'])
            ->first();

        if ($existingRental) {
            // Redirect back with a message if there is an ongoing rental process
            return redirect()->back()->with('error', 'You already have an ongoing rental process for this book.');
        }

        // Create a new rental request
        Borrow::create([
            'reader_id' => auth()->id(),
            'book_id' => $bookId,
            'status' => 'PENDING',
        ]);

        return redirect()->route('bookDetails', $bookId);
    }
}
