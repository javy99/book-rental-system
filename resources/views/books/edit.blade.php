@extends('layouts.main')

@section('content')
<main class="container mx-auto p-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-3xl font-bold mb-4">Edit Book</h2>

        <form action="{{ route('updateBook', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="title">Title</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title" value="{{ $book->title }}" required>
                @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Authors -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="authors">Authors</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="authors" name="authors" type="text" placeholder="Authors" value="{{ $book->authors }}" required>
                @error('authors')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Released Date -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="released_at">Released Date</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="released_at" name="released_at" type="date" value="{{ $book->released_at }}" required>
                @error('released_at')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pages -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="pages">Pages</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pages" name="pages" type="number" placeholder="Pages" value="{{ $book->pages }}" required>
                @error('pages')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- ISBN -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="isbn">ISBN</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="isbn" name="isbn" type="text" placeholder="ISBN" value="{{ $book->isbn }}" required pattern="^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$">
                @error('isbn')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="description">Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Description">{{ $book->description }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Genres -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Genres</label>
                @foreach($genres as $genre)
                <div class="flex items-center">
                    <input class="mr-2 leading-tight" type="checkbox" id="genre_{{ $genre->id }}" name="genres[]" value="{{ $genre->id }}" {{ $book->genres->contains($genre->id) ? 'checked' : '' }}>
                    <label class="block text-sm" for="genre_{{ $genre->id }}">
                        {{ $genre->name }}
                    </label>
                </div>
                @endforeach
                @error('genres')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- In Stock -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="in_stock">In Stock</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="in_stock" name="in_stock" type="number" placeholder="In Stock" value="{{ $book->in_stock }}" required min="0">
                @error('in_stock')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Book</button>
        </form>
    </div>
</main>
@endsection