<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'genre', 'year', 'rating', 'episode_count', 'available_episode', 'view_count'
    ];
}
