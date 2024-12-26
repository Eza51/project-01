<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'account_id',
        'title',
        'slug',
        'posted_by',
        'posted_on',
        'image',
        'short_description',
        'description',
        'views',
        'status',
    ];
//singular pulular category function singular karon wkta blog ekta ctegory
//same for account singular
    /**
     * @return BelongsTo
     */
    //Blog is categorized under exactly one BlogCategory.
    public function category(): BelongsTo
    //ekta blog caterory er under e thakbe thats why belonsg to
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo

    //blog acoount er under eo thkbe
    {
        return $this->belongsTo(Account::class, 'account_id')->with('address');
    }
}
