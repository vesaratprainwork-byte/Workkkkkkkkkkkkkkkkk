<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Genre extends Model
{
    use HasFactory;

    
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    
    protected $fillable = ['code', 'name', 'description'];

    
    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class, 'genre_code', 'code');
    }
}