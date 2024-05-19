@extends('layouts.main')

@section('content')

<main class="container mx-auto p-8">
    <h2 class="text-2xl font-bold mb-4">Search Results</h2>
    @foreach($books as $book)
    <div class="mb-4">
        <h3 class="text-xl font-semibold">{{ $book->title }}</h3>
        <p class="text-gray-600"><b>Author:</b> {{ $book->authors }}</p>
        <p class="text-gray-600"><b>Date of publish: </b>{{ $book->released_at }}</p>
        <p>{{ $book->description }}</p>
        <a href="{{ route('bookDetails', $book->id) }}" class="text-blue-500">View Details</a>
    </div>
    @endforeach
</main>

@endsection