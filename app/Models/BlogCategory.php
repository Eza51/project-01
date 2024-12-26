<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    /**
     * @return HasMany
     */
    //one to mny=hasmny
    //1 ta category 2 ta blog er under e thakte oarbe so 1 to mnny
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }
}
