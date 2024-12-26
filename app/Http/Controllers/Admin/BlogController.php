<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BlogDataTable;
use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BlogDataTable $dataTable
     * @return mixed
     */
    public function index(BlogDataTable $dataTable): mixed
    {
        return $dataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = $this->getBlogCategories();

        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlogRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBlogRequest $request): RedirectResponse
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param Blog $blog
     * @return View
     */
    public function show(Blog $blog): View
    {
        $categories = $this->getBlogCategories();

        return view('admin.blog.show', compact('blog', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $blog
     * @return View
     */
    public function edit(Blog $blog): View
    {
        $categories = $this->getBlogCategories();

        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBlogRequest $request
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        try {
            // Image delete
            $imagePath = $blog->__get('image');

            if ($imagePath && Storage::exists('public/uploads/blogs/' . $imagePath)) {
                Storage::delete('public/uploads/blogs/' . $imagePath);
            }

            $blog->delete();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Blog post has been deleted successfully!'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getBlogCategories(): Builder|Collection
    {
        return BlogCategory::query()
            ->where('status', '=', 1)
            ->orderBy('name')
            ->get();
    }
}
