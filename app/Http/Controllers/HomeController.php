<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Blog;
use App\Models\JobApply;
use App\Models\JobCategory;
use App\Models\JobPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


/**__invoke(Request $request): View - Handles the request to populate the home page view.

latestBlogPosts(): Builder|Collection - Retrieves the latest published blog posts with associated details.

topCategories(): Builder|Collection - Fetches top job categories based on job counts.

topJobs(): Builder|Collection - Retrieves top job posts with detailed information.

topCompanies(): Builder|Collection - Fetches top employer accounts with approved status based on job counts. */
class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $blogs = $this->latestBlogPosts();
        $topCategories = $this->topCategories();
        $topJobs = $this->topJobs();
        $topCompanies = $this->topCompanies();

        $applies = [];

        $accountId = Auth::guard('account')->id();
        if ($accountId) {
            // JobSeeker Applies Job Posts
            $applies = JobApply::query()
                ->where('account_id', $accountId)
                ->pluck('job_post_id')->toArray();
        }

        return view('app.index', compact('blogs', 'topCategories', 'topJobs', 'topCompanies', 'applies'));
    }

    /**
     * @return Builder[]|Collection
     */
    private function latestBlogPosts(): Builder|Collection
    {
        return Blog::with(['account', 'category'])
            ->where('status', '=', 'publish')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();
    }

    /**
     * @return Builder[]|Collection
     */
    private function topCategories(): Builder|Collection
    {
        return JobCategory::query()->withCount('jobs')
            ->where('status', '=', 1)
            ->orderByDesc('jobs_count')
            ->limit(8)
            ->get();
    }

    /**
     * @return Builder[]|Collection
     */
    private function topJobs(): Builder|Collection
    {
        return JobPost::with([
            'category',
            'account',
            'attributes',
            'attributeOther',
            'location',
            'salary'
        ])
            ->where('status', '=', 'Publish')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();
    }

    /**
     * @return Builder[]|Collection
     */
    private function topCompanies(): Builder|Collection
    {
        return Account::query()->withCount('jobs')
            ->where('status', '=', 'Approved')
            ->where('account_type', 'Employer')
            ->orderByDesc('jobs_count')
            ->limit(8)
            ->get();
    }
}
