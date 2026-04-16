<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Allow these fields to be saved to the database
    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'category', 
        'condition', 
        'availability_status'
    ];

    /**
     * Relationship: The owner of the item (The Lender)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: The history of loans for this item
     * This is the line that fixes your error!
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}