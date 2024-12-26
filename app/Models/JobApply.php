<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'job_post_id',
        'cover_letter',
        'resume_path',
        'feedback',
        'interview_date',
        'status',
    ];

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)->with('address');
    }

    /**
     * @return BelongsTo
     */
    public function jobPost(): BelongsTo
    {//reltionship decalres job_post_id foreign key of jobapply
        return $this->belongsTo(JobPost::class, 'job_post_id')
            ->with(['account', 'salary', 'attributes']);

            //with used for shorten query
            //with means account slry attribute from jobpost has also relationshop with job apply
            //but aigula to foreign key na that's why with die liksi
    }
}
