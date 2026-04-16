<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['name', 'email', 'password', 'role', 'reputation_score'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function loans() {
        return $this->hasMany(Loan::class);
    }

    // NEW: Rank-Based Borrowing Limit Logic
    public function getBorrowingLimit()
    {
        if (str_contains($this->name, 'E-1')) return 5;
        if (str_contains($this->name, 'E-2')) return 10;
        if (str_contains($this->name, 'E-3')) return 15;
        if (str_contains($this->name, 'Gen')) return 100; // Generals have no limit
        return 3; // Default for others
    }
}