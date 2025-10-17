<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'release_year',
        'poster_url',
        'genre_code',
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_code', 'code');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }


    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class, 'movie_provider');
    }
}
