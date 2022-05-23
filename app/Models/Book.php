<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity'
    ];

    public $timestamps = false;

    public function rentals()
    {
        return $this->hasMany(Comment::class);
    }
}
