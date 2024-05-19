@extends('layouts.main')

@section('content')

<main class="container mx-auto p-8">
    <section>
        <!-- Dynamic Genre Name -->
        <h1 class="text-3xl font-bold mb-6">Genre: {{ $genre->name }}</h1>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($books as $book)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition duration-200">
                <h2 class="text-xl font-bold mb-2">{{ $book->title }}</h2>
                <p class="text-gray-700">Author: {{ $book->authors }}</p>
                <p class="text-gray-700">Released: {{ $book->released_at }}</p>
                <p class="mt-4 text-gray-600">{{ $book->description}}</p>
                <!-- Link to the book detail page -->
                <a href="{{ route('bookDetails', $book->id) }}" class="inline-block mt-4 text-blue-500 hover:text-blue-600">View Details</a>
            </div>
            @endforeach
        </div>
    </section>
</main>

@endsection
