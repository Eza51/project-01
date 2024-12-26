<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'status',
    ];

    /**
     * @param int $id
     * @return int
     */
    public function exist(int $id): int
    {
        return JobPostAttribute::query()//JObAttribute Model eta but era 
        //JObpostAttribute e ai model(Jobattribute) id ase kina eta check kore
            ->where('job_attribute_id', '=', $id)
            ->count();
    }
}
//method named exist() to check if a given attribute ID exists in the JobPostAttribute table.
