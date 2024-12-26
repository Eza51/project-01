<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'company',
        'position',
        'from',
        'to',
        'description',
        'status',
    ];
}
