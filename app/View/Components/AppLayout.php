<?php

namespace App\View\Components;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Genre;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $userCount = User::count();
        $bookCount = Book::count();
        $genreCount = Genre::count();
        $activeRentals = Borrow::where('status', "ACCEPTED")->count();
        $genres = Genre::all();

        return view('main', compact('userCount', 'bookCount', 'genreCount', 'activeRentals', 'genres'));
    }
}
