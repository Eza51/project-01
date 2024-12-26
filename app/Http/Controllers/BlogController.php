<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */
    /**index(Request $request): View - Handles home page blog display with category and search filters.

detail(string $slug): View - Displays details of a specific blog post and increments its view count.

getCategories(): Builder|Collection - Retrieves blog categories with published blog counts. */

     //ETa HOME E BLOG DEKHAY
    public function index(Request $request): View
    {
        $categorySlug = $request->input('category');
        $search = $request->input('search');

        $blogs = Blog::with(['account', 'category']);
        $blogs = $blogs->where('status', '=', 'Publish');

        if ($categorySlug) {
            $blogs = $blogs->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }

        if ($search) {
            $blogs = $blogs->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('short_description', 'like', '%' . $search . '%');
            });
        }

        $blogs = $blogs->orderByDesc('created_at');
        $blogs = $blogs->get();

        $categories = $this->getCategories();

        return view('app.blog.index', compact('blogs', 'categories'));
    }

    /**
     * @param string $slug
     * @return View
     * @throws Exception
     */
    public function detail(string $slug): View
    {
        $blog = Blog::with(['account', 'category'])
            ->where('status', '=', 'Publish')
            ->where('slug', '=', $slug)
            ->orderByDesc('created_at')
            ->firstOrFail();

        $categories = $this->getCategories();

       //id the dhore ager view update,,lrvl e incrtmnt aivbe kaj kre 


        Blog::query()// query 
            ->where('id', $blog->__get('id'))// Filter the query to find the blog post with the given ID
            
            ->increment('views');// Increment the 'views' column by 1 for the matched blog post


        return view('app.blog.detail', compact('blog', 'categories'));
    }

    /**
     * @return Builder[]|Collection
     */
    private function getCategories(): Builder|Collection
    {
        return BlogCategory::query()->withCount(['blogs' => function ($query) {
            $query->where('status', 'Publish');
        }])->get();
    }
}
