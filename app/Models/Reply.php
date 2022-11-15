<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function($reply){
    //         $reply->user_id = auth()->id();
    //     });
    // }

    public function question()
    {
        // Every reply is under some question
        // So reply belong to Questions
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

}
