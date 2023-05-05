<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('status')
            ->withTimestamps()
            ->wherePivot('status', 'accepted');
    }

    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps()
            ->wherePivot('status', 'pending');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
