@extends('layouts.main')

@section('content')
<main class="container mx-auto p-8">
    <section>
        <a href="{{ route('createGenre') }}" class="mt-8 mb-8 btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new genre</a>
        <h1 class="text-3xl font-bold mb-6 mt-8">Genre List</h1>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($genres as $genre)
            <div class="rounded-lg shadow hover:shadow-md transition duration-200 p-4
                        @if($genre->style === 'primary')
                            bg-blue-500 text-white
                        @elseif($genre->style === 'secondary')
                            bg-gray-500 text-white
                        @elseif($genre->style === 'success')
                            bg-green-500 text-white
                        @elseif($genre->style === 'danger')
                            bg-red-500 text-white
                        @elseif($genre->style === 'warning')
                            bg-yellow-500 text-white
                        @elseif($genre->style === 'info')
                            bg-blue-200 text-black
                        @elseif($genre->style === 'light')
                            bg-gray-100 text-black
                        @elseif($genre->style === 'dark')
                            bg-gray-900 text-white
                        @endif
                    ">
                <h2 class="text-xl font-bold mb-2">{{ $genre->name }}</h2>
                <p class="mb-4"><b>Style:</b> {{ $genre->style }}</p>

                <a href="{{ route('editGenre', $genre->id) }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <form action="{{ route('deleteGenre', $genre->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection