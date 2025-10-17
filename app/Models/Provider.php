<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo_url', 'url'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_provider');
    }
}
