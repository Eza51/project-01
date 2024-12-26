<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'job_category_id',
        'title',
        'slug',
        'description',
        'vacancy',
        'deadline',
        'status',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(JobPostAttribute::class)->with('attribute');
    }

    /**
     * @return HasOne
     */
    public function attributeOther(): HasOne
    {
        return $this->hasOne(JobPostAttributeOther::class);
    }

    /**
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(JobPostLocation::class)->with(['country', 'state', 'city']);
    }

    /**
     * @return HasOne
     */
    public function salary(): HasOne
    {
        return $this->hasOne(JobPostSalary::class);
    }

    /**
     * @return HasMany
     */
    public function jobApplies(): HasMany
    {
        return $this->hasMany(JobApply::class, 'job_post_id')
            ->with(['account']);
    }


    /**For account_id = 1, the ratings from job_applies linked to job posts with account_id = 1 are:
Engineer (job_post_id = 101): 4
Developer (job_post_id = 102): 5
Designer (job_post_id = 105): NULL (not counted due to t1.rating > 0 condition)
Calculation: (4 + 5) / 2 = 4.5 */







   



public static function rating($account_id)
    {
        
        
     //select collumn data rtrve//Innerjoin->join row//t1=jobapplies jobpost id,,
     //Joins job_applies with job_posts based on job_post_id
     //rating is NULL or 0, ensuring only valid ratings are considered
     //?paraemetr placed holder account_id=compnay
     //This query fetches ratings (t1.rating) from 
     //job_applies linked to job posts (job_posts) where account_id is 1


//AccountController


        $sql = "SELECT 
            AVG(t1.rating) AS rating
            FROM
            job_applies t1
            INNER JOIN job_posts t2 ON t1.job_post_id=t2.id
            WHERE t1.rating > 0 AND t2.account_id=?
            ";


            //accountid=fr whch cmpny

        $row = DB::select($sql, [$account_id]);
//executes an SQL query ($sql) db
//It replaces placeholders (?) with actual values from the array ([$account_id])
//stored in the variable $row
       
        $rating = isset($row[0]->rating) ? $row[0]->rating : 0;

//ensures that $rating receives the value of $row[0]->rating if it exists.
//default 0
         //isset() is a PHP function that determines if a variable is set and is not null
        return $rating;
    }
}
