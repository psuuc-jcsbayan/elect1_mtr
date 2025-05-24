<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    // Add this method to define the relationship
    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
        
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
    
}
