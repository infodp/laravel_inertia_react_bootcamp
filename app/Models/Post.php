<?php

namespace App\Models;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    protected $fillable = [
        'title',
        'body'
    ];

    protected $dispatchesEvents = [
        'created' => PostCreated::class
    ];
}
