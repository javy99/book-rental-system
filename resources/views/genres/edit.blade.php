@extends('layouts.main')

@section('content')
<main class="container mx-auto p-8">
    <section>
        <h1 class="text-3xl font-bold mb-6">Edit Genre</h1>
        <form action="{{ route('updateGenre', $genre->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $genre->name) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="style" class="block text-sm font-bold mb-2">Style</label>
                <select id="style" name="style" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                    <option value="primary" {{ old('style', $genre->style) === 'primary' ? 'selected' : '' }}>Primary</option>
                    <option value="secondary" {{ old('style', $genre->style) === 'secondary' ? 'selected' : '' }}>Secondary</option>
                    <option value="success" {{ old('style', $genre->style) === 'success' ? 'selected' : '' }}>Success</option>
                    <option value="danger" {{ old('style', $genre->style) === 'danger' ? 'selected' : '' }}>Danger</option>
                    <option value="warning" {{ old('style', $genre->style) === 'warning' ? 'selected' : '' }}>Warning</option>
                    <option value="info" {{ old('style', $genre->style) === 'info' ? 'selected' : '' }}>Info</option>
                    <option value="light" {{ old('style', $genre->style) === 'light' ? 'selected' : '' }}>Light</option>
                    <option value="dark" {{ old('style', $genre->style) === 'dark' ? 'selected' : '' }}>Dark</option>
                </select>
                @error('style')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Genre</button>
        </form>
    </section>
</main>
@endsection
