@extends('layouts.main')

@section('content')
<header class="text-center p-12 text-gray-800">
    <h1 class="text-4xl font-bold mb-4">Welcome to the Book Rental System</h1>
    <p class="mb-8">Explore a wide range of books across different genres.</p>
</header>

<main class="container mx-auto p-8">
    <section class="mb-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Statistics Section -->
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold mb-2">Users</h2>
            <p class="text-2xl">{{ $userCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold mb-2">Genres</h2>
            <p class="text-2xl">{{ $genreCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold mb-2">Books</h2>
            <p class="text-2xl">{{ $bookCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold mb-2">Active Rentals</h2>
            <p class="text-2xl">{{ $activeRentals }}</p>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Genres</h2>
        <div class="flex flex-wrap">
            @foreach($genres as $genre)
            @php
            $bgColorClass = '';
            $textColorClass = 'text-white';
            switch($genre->style) {
            case 'primary':
            $bgColorClass = 'bg-blue-500';
            break;
            case 'secondary':
            $bgColorClass = 'bg-gray-500';
            break;
            case 'success':
            $bgColorClass = 'bg-green-500';
            break;
            case 'danger':
            $bgColorClass = 'bg-red-500';
            break;
            case 'warning':
            $bgColorClass = 'bg-yellow-500';
            break;
            case 'info':
            $bgColorClass = 'bg-blue-200';
            break;
            case 'light':
            $bgColorClass = 'bg-gray-100';
            $textColorClass = 'text-black';
            break;
            case 'dark':
            $bgColorClass = 'bg-gray-900';
            break;
            default:
            $bgColorClass = 'bg-gray-500';
            }
            @endphp
            <a href="{{ route('listByGenre', ['genreName' => $genre->name]) }}" class="m-2 font-bold py-2 px-4 shadow rounded {{ $bgColorClass }} {{ $textColorClass }}">
                {{ $genre->name }}
            </a>

            @endforeach
        </div>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Search for Books</h2>
        <form action="{{ route('searchBooks') }}" method="GET" class="flex justify-center">
            <input name="query" type="text" class="px-4 py-2 w-full md:w-1/2" placeholder="Search by title or author...">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-4">Search</button>
        </form>
    </section>
</main>
@endsection