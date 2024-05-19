@extends('layouts.main')

@section('content')

<main class="container mx-auto p-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">My Rental Details</h2>

        <div>
            <h3 class="text-lg font-bold mb-2">Book</h3>
            <p><b>Title:</b> {{ $rental->book->title }}</p>
            <p><b>Author:</b> {{ $rental->book->authors }}</p>
            <p><b>Date of Rental:</b> {{ $rental->created_at->format('Y-m-d') }}</p>
            <p><a class="inline-block mt-4 text-blue-500 hover:text-blue-600" href="{{ route('bookDetails', $rental->book->id) }}">View Book Details</a></p>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Rental Data</h3>
            <p><b>Name of Borrower:</b> {{ $rental->user->name }}</p>
            <p><b>Date of Rental Request:</b> {{ $rental->created_at->format('Y-m-d') }}</p>
            <p><b>Status:</b> {{ $rental->status }}</p>
            @if ($rental->status !== 'PENDING')
            <p><b>Date of Procession:</b> {{ $rental->request_processed_at instanceof \Illuminate\Support\Carbon ? $rental->request_processed_at->format('Y-m-d') : 'Not available' }}</p>
            <p><b>Librarian's Name:</b> {{ $rental->requestManager->name }}</p>
            @endif
            @if ($rental->status === 'RETURNED')
            <p><b>Date of Return:</b> {{ $rental->returned_at instanceof \Illuminate\Support\Carbon ? $rental->returned_at->format('Y-m-d') : 'Not available' }}</p>
            <p><b>Librarian's Name:</b> {{ $rental->requestManager->name ?? 'Not available' }}</p>
            @endif
            @if ($rental->status !== 'PENDING' && $rental->deadline && $rental->deadline < now()) <p><b>This rental is late.</b></p>
                @endif
        </div>
    </div>
</main>

@endsection