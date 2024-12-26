<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;//meaning
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //hasapi permission for api
    //has factory used to test data
    //notifiable...send notifications to model
//mane er bahire r kisu fill korte parbo na bahire theke fillable
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'account_type',
        'gender',
        'date_of_birth',
        'avatar_image',
        'cover_image',
        'is_public_profile',
        'views',
        'password',
        'email_verified_at',
        'remember_token',
        'plugins',
        'description',
        'status',
    ];
// protected $hidden property sensitive information from being exposed in API response
    protected $hidden = [
        'password',
        'remember_token',
    ];
//hasOne=1 to 1...1 ta accnt 1 tai adrees thkbe21   
    /**
     * @return HasOne
     */
    //Account model has a hasOne relationship with the Address model
    //adress model er sathe with die country sate cty for avoiding additional query
    //adress er sathe country state city o load hobe
    public function address(): HasOne
    {
        return $this->hasOne(Address::class)->with(['country', 'state', 'city']);//adress model e ase
    }

    /**
     * @return HasMany
     */
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    /**
     * @return HasMany
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * @return HasMany
     */
    public function jobs(): HasMany
    {// The return type declaration indicates that this method returns a HasMany relationship.
        return $this->hasMany(JobPost::class);
    }

    /**
     * @return HasMany
     */
    public function jobApplies(): HasMany
    {
        return $this->hasMany(JobApply::class);
    }
}
