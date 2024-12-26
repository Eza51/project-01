<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'school',
        'degree',
        'from',
        'to',
        'description',
        'status',
    ];
}
