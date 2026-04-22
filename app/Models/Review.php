<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    protected $fillable = ['user_id', 'reviewer_id', 'review_text', 'rating'];

    public function user() // The person being reviewed
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer() // The person who wrote the review
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}