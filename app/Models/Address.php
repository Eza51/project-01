<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;//primary key nei tai null//primary key incremnet auto hoi..oita bad
    protected $fillable = [
        'account_id',
        'country_id',
        'state_id',
        'city_id',
        'address',
    ];

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        //adreess model belongsto reltn with coutry
        //country_id primary key to country table and foreign key in adress table
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    //belongs to meanings city adress er under e thake
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
