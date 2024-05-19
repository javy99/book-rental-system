<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the librarian's rentals.
     */
    public function indexLibrarian()
    {
        $userRentals = Borrow::with('book')
            ->where('status', '!=', 'RETURNED')
            ->get();

        $pendingRentals = $userRentals->where('status', 'PENDING');
        $acceptedOnTimeRentals = $userRentals->where('status', 'ACCEPTED')->whereNull('returned_at');
        $acceptedLateRentals = $userRentals->where('status', 'ACCEPTED')->whereNotNull('returned_at');
        $rejectedRentals = $userRentals->where('status', 'REJECTED');
        $returnedRentals = $userRentals->where('status', 'RETURNED');

        return view('rentals.indexLibrarian', compact('pendingRentals', 'acceptedOnTimeRentals', 'acceptedLateRentals', 'rejectedRentals', 'returnedRentals'));
    }

    /**
     * Display a listing of the reader's rentals.
     */
    public function indexReader()
    {
        $userRentals = Borrow::with('book')
            ->where('reader_id', auth()->id())
            ->get();

        $pendingRentals = $userRentals->where('status', 'PENDING');
        $acceptedOnTimeRentals = $userRentals->where('status', 'ACCEPTED')->whereNull('returned_at');
        $acceptedLateRentals = $userRentals->where('status', 'ACCEPTED')->whereNotNull('returned_at');
        $rejectedRentals = $userRentals->where('status', 'REJECTED');
        $returnedRentals = $userRentals->where('status', 'RETURNED');

        return view('rentals.indexReader', compact('pendingRentals', 'acceptedOnTimeRentals', 'acceptedLateRentals', 'rejectedRentals', 'returnedRentals'));
    }


    public function showReader($id)
    {
        $rental = Borrow::with(['book'])->where('reader_id', auth()->id())->findOrFail($id);

        return view('rentals.showReader', compact('rental'));
    }

    public function showLibrarian($id)
    {
        $rental = Borrow::with(['book'])->findOrFail($id);

        return view('rentals.showLibrarian', compact('rental'));
    }


    /**
     * Update the status and deadline of a rental.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'status' => 'required|in:PENDING,ACCEPTED,REJECTED,RETURNED',
            'deadline' => 'nullable|date|after:today',
            'returned_at' => 'nullable|date',
        ]);

        // Find the rental
        $rental = Borrow::findOrFail($id);

        // Update the rental
        $rental->status = $validatedData['status'];
        $rental->deadline = $validatedData['deadline'];

        // Check if 'returned_at' key exists in validatedData before accessing it
        if (array_key_exists('returned_at', $validatedData)) {
            $rental->returned_at = $validatedData['returned_at'];
        }

        // Set the return_managed_by if status is RETURNED
        if ($rental->status === 'RETURNED') {
            $rental->return_managed_by = auth()->id();
        }

        // Update request_processed_at if the status is not PENDING and it wasn't previously set
        if ($rental->status !== 'PENDING' && !$rental->request_processed_at) {
            $rental->request_processed_at = now();
        }

        $rental->request_managed_by = auth()->id();

        $rental->save();

        // Redirect back to the rental details page
        return redirect()->route('librarianRentalDetails', $id)->with('success', 'Rental updated successfully!');
    }
}
