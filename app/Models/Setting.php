<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models
 *

 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_name',
        'value',
    ];
}
