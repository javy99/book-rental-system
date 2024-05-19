@extends('layouts.main')

@section('content')
<main class="container mx-auto p-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-3xl font-bold mb-4">{{$book->title}}</h2>
        <p class="mb-2"><b>Author:</b> {{$book->authors}}</p>
        <p class="mb-2"><b>Genre:</b>
            @forelse($book->genres as $genre)
            <span>{{ $genre->name }}@if(!$loop->last), @endif</span>
            @empty
            <span>No genres listed.</span>
            @endforelse
        </p>
        <p class="mb-2"><b>Date of publish:</b> {{$book->released_at}}</p>
        <p class="mb-2"><b>Number of pages:</b> {{$book->pages}}</p>
        <p class="mb-2"><b>Language:</b> {{$book->language_code}}</p>
        <p class="mb-2"><b>ISBN number:</b> {{$book->isbn}}</p>
        <p class="mb-2"><b>In Stock:</b> {{$book->in_stock}}</p>
        <p class="mb-4"><b>Description:</b> {{$book->description}}</p>
        @if($book->cover_image)
        <img src="{{ $book->cover_image }}" alt="Cover Image of {{ $book->title }}" class="w-full max-w-sm mb-4">
        @endif

        @if (auth()->check() && auth()->user()->is_librarian)
        <a href="{{ route('editBook', $book->id) }}" class="mt-8 btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>

        <form action="{{ route('deleteBook', $book->id) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
        </form>
        @endif


        @if (auth()->check() && !auth()->user()->is_librarian)
        @if (!$ongoingRental)
        <form action="{{ route('borrowBook', $book->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Borrow this book</button>
        </form>
        @else
        <p class="font-bold mt-4">You already have an ongoing rental process for this book.</p>
        @endif
        @elseif(auth()->check())
        <p class="font-bold mt-4">Only Reader users can borrow books.</p>
        @else
        <p class="font-bold mt-4">You need to <a style="text-decoration-line: underline" href="{{ route('login') }}">login</a> to borrow a book.</p>
        @endif
    </div>
</main>
@endsection