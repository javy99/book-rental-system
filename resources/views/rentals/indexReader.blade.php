@extends('layouts.main')

@section('content')
<div class="container mx-auto p-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">My Rentals</h2>

        <div>
            <h3 class="text-lg font-bold mb-2">Rental Requests with Pending Status</h3>
            @if($pendingRentals->isEmpty())
            <p>No pending rental requests.</p>
            @else
            <ul>
                @foreach($pendingRentals as $rental)
                <li class="mb-6">
                    <b>Title:</b> {{ $rental->book->title ?? 'Unknown Title' }}
                    <br>
                    <b>Author:</b> {{ $rental->book->authors ?? 'Unknown Author' }}
                    <br>
                    <b>Date of Rental:</b> {{ $rental->created_at->format('Y-m-d') }}
                    <br>
                    <b>Deadline:</b> {{ $rental->deadline instanceof \Illuminate\Support\Carbon ? $rental->deadline->format('Y-m-d') : 'Not specified' }}
                    <a href="{{ route('readerRentalDetails', $rental->id) }}" class="block text-blue-500 hover:text-blue-600">View Details</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Accepted and In-Time Rentals (Before Deadline)</h3>
            @if($acceptedOnTimeRentals->isEmpty())
            <p>No accepted in-time rentals before the deadline.</p>
            @else
            <ul>
                @foreach($acceptedOnTimeRentals as $rental)
                <li class="mb-6">
                    <b>Title:</b> {{ $rental->book->title ?? 'Unknown Title' }}
                    <br>
                    <b>Author:</b> {{ $rental->book->authors ?? 'Unknown Author' }}
                    <br>
                    <b>Date of Rental:</b> {{ $rental->created_at->format('Y-m-d') }}
                    <br>
                    <b>Deadline:</b> {{ $rental->deadline instanceof \Illuminate\Support\Carbon ? $rental->deadline->format('Y-m-d') : 'Not specified' }}
                    <a href="{{ route('readerRentalDetails', $rental->id) }}" class="block text-blue-500 hover:text-blue-600">View Details</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Accepted Late Rentals (After Deadline)</h3>
            @if($acceptedLateRentals->isEmpty())
            <p>No accepted late rentals after the deadline.</p>
            @else
            <ul>
                @foreach($acceptedLateRentals as $rental)
                <li class="mb-6">
                    <b>Title:</b> {{ $rental->book->title ?? 'Unknown Title' }}
                    <br>
                    <b>Author:</b> {{ $rental->book->authors ?? 'Unknown Author' }}
                    <br>
                    <b>Date of Rental:</b> {{ $rental->created_at->format('Y-m-d') }}
                    <br>
                    <b>Deadline:</b> {{ $rental->deadline instanceof \Illuminate\Support\Carbon ? $rental->deadline->format('Y-m-d') : 'Not specified' }}
                    <a href="{{ route('readerRentalDetails', $rental->id) }}" class="block text-blue-500 hover:text-blue-600">View Details</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Rejected Rental Requests</h3>
            @if($rejectedRentals->isEmpty())
            <p>No rejected rental requests.</p>
            @else
            <ul>
                @foreach($rejectedRentals as $rental)
                <li class="mb-6">
                    <b>Title:</b> {{ $rental->book->title ?? 'Unknown Title' }}
                    <br>
                    <b>Author:</b> {{ $rental->book->authors ?? 'Unknown Author' }}
                    <br>
                    <b>Date of Rental:</b> {{ $rental->created_at->format('Y-m-d') }}
                    <br>
                    <b>Deadline:</b> {{ $rental->deadline instanceof \Illuminate\Support\Carbon ? $rental->deadline->format('Y-m-d') : 'Not specified' }}
                    <a href="{{ route('readerRentalDetails', $rental->id) }}" class="block text-blue-500 hover:text-blue-600">View Details</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-bold mb-2">Returned Rentals</h3>
            @if($returnedRentals->isEmpty())
            <p>No returned rentals.</p>
            @else
            <ul>
                @foreach($returnedRentals as $rental)
                <li class="mb-6">
                    <b>Title:</b> {{ $rental->book->title ?? 'Unknown Title' }}
                    <br>
                    <b>Author:</b> {{ $rental->book->authors ?? 'Unknown Author' }}
                    <br>
                    <b>Date of Rental:</b> {{ $rental->created_at->format('Y-m-d') }}
                    <br>
                    <b>Deadline:</b> {{ $rental->deadline instanceof \Illuminate\Support\Carbon ? $rental->deadline->format('Y-m-d') : 'Not specified' }}
                    <a href="{{ route('readerRentalDetails', $rental->id) }}" class="block text-blue-500 hover:text-blue-600">View Details</a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

    </div>
</div>
@endsection