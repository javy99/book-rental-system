<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'style'];

    // Define the relationship with books
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
