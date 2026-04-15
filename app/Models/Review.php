<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // <--- ADD THIS LINE

class Review extends Model
{
    // In app/Models/Review.php

public function user() // The person being reviewed
{
    return $this->belongsTo(User::class, 'user_id');
}

public function reviewer() // The person who wrote the review
{
    return $this->belongsTo(User::class, 'reviewer_id');
}
}
