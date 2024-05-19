<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'reader_id',
        'book_id',
        'status',
        'request_processed_at',
        'request_managed_by',
        'deadline',
        'returned_at',
        'return_managed_by',
    ];

    protected $dates = [
        'request_processed_at',
        'returned_at',
    ];


    // Define the relationship with users (readers)
    public function user()
    {
        return $this->belongsTo(User::class, 'reader_id');
    }

    // Define the relationship with librarians for request management
    public function requestManager()
    {
        return $this->belongsTo(User::class, 'request_managed_by');
    }

    // Define the relationship with librarians for return management
    public function returnManager()
    {
        return $this->belongsTo(User::class, 'return_managed_by');
    }

    // Define the relationship with the Book model
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
