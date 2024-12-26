<?php

namespace App\Http\Controllers;

use App\Models\JobApply;
use App\Models\JobCategory;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
/**index(): View - Fetches job categories with job counts, ordered by name, for display.

jobs(string $slug): View - Retrieves published jobs within a specific job category identified by its slug.

applies(): array - Returns job post IDs for which the logged-in user (Job Seeker) has applied. */
class JobCategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $categories = JobCategory::query()->withCount('jobs')
            ->where('status', '=', 1)
            ->orderByDesc('name')
            ->get();

        return view('app.job_category.index', compact('categories'));
    }

    /**
     * @param string $slug
     * @return View
     */
    public function jobs(string $slug): View
    {
        $category = JobCategory::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $jobs = JobPost::with('category')
            ->whereHas('category', function($category) use ($slug) {
                $category->where('slug', $slug);
            })
            ->where('status', '=', 'Publish')
            ->paginate();

        $applies = $this->applies();

        return view('app.job_category.jobs', compact('jobs', 'category', 'applies'));
    }

    /**
     * @return array
     */
    private function applies(): array
    {
        $accountId = Auth::guard('account')->id();

        if ($accountId) {
            // JobSeeker Applies Job Posts
            return JobApply::query()
                ->where('account_id', $accountId)
                ->pluck('job_post_id')->toArray();
        }

        return [];
    }
}
