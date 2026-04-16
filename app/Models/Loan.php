<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'item_id', 'due_date', 'status'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Relationship: The person who borrowed the item
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}