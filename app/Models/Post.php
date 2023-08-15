<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'url',
        'community_id',
        'user_id',
    ];


    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
}
