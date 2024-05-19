@extends('layouts.main')

@section('content')

<main class="container mx-auto p-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Rental Details</h2>

        <div>
            <h3 class="text-lg font-bold mb-2">Book</h3>
            <p><b>Title:</b> {{ $rental->book->title }}</p>
            <p><b>Author:</b> {{ $rental->book->authors }}</p>
            <p><b>Date of Rental:</b> {{ $rental->created_at instanceof \Illuminate\Support\Carbon ? $rental->created_at->format('Y-m-d') : 'Not available' }}</p>
            <p><a class="inline-block mt-4 text-blue-500 hover:text-blue-600" href="{{ route('bookDetails', $rental->book->id) }}">View Book Details</a></p>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Rental Data</h3>
            <p><b>Name of Borrower:</b> {{ $rental->user->name }}</p>
            <p><b>Date of Rental Request:</b> {{ $rental->created_at instanceof \Illuminate\Support\Carbon ? $rental->created_at->format('Y-m-d') : 'Not available' }}</p>
            <p><b>Status:</b> {{ $rental->status }}</p>
            @if ($rental->status !== 'PENDING')
            @php
            $processedAt = $rental->request_processed_at instanceof \Illuminate\Support\Carbon ? $rental->request_processed_at : \Illuminate\Support\Carbon::parse($rental->request_processed_at);
            @endphp
            <p><b>Date of Procession:</b> {{ $processedAt->format('Y-m-d') }}</p>
            @endif
            <p><b>Request Librarian's Name:</b> {{ $rental->requestManager->name }}</p>

            @if ($rental->status === 'RETURNED')
            @php
            $returnedAt = $rental->returned_at instanceof \Illuminate\Support\Carbon ? $rental->returned_at : \Illuminate\Support\Carbon::parse($rental->returned_at);
            @endphp
            <p><b>Date of Return:</b> {{ $returnedAt->format('Y-m-d') }}</p>
            @endif
            <p><b>Return Librarian's Name: </b>{{ $rental->returnManager->name }}</p>
            @if ($rental->status !== 'PENDING' && $rental->deadline && $rental->deadline < now()) <p><b>This rental is late.</b></p>
                @endif
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Update Rental</h3>
            <form action="{{ route('rentalUpdate', $rental->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="PENDING" @if($rental->status === 'PENDING') selected @endif>PENDING</option>
                        <option value="ACCEPTED" @if($rental->status === 'ACCEPTED') selected @endif>ACCEPTED</option>
                        <option value="REJECTED" @if($rental->status === 'REJECTED') selected @endif>REJECTED</option>
                        <option value="RETURNED" @if($rental->status === 'RETURNED') selected @endif>RETURNED</option>
                    </select>
                    @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input type="date" id="deadline" name="deadline" value="{{ $rental->deadline ? \Illuminate\Support\Carbon::parse($rental->deadline)->format('Y-m-d') : '' }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('deadline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Rental
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection