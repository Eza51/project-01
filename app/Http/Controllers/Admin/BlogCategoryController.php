<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BlogCategoryDataTable;
use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogCategoryRequest;
use App\Http\Requests\Admin\UpdateBlogCategoryRequest;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BlogCategoryDataTable $dataTable
     * @return mixed
     */
    public function index(BlogCategoryDataTable $dataTable): mixed
    {
        return $dataTable->render('admin.blog_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.blog_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlogCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBlogCategoryRequest $request): RedirectResponse
    {
        $request->validated();

        try {
            $blogCategory = new BlogCategory();
            $blogCategory->fill([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'status' => $request->input('status') ?? 0,
            ]);
            $blogCategory->save();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Blog Category has been created successfully!'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param BlogCategory $blogCategory
     * @return View
     */
    public function show(BlogCategory $blogCategory): View
    {
        return view('admin.blog_category.show', compact('blogCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogCategory $blogCategory
     * @return View
     */
    public function edit(BlogCategory $blogCategory): View
    {
        return view('admin.blog_category.edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBlogCategoryRequest $request
     * @param BlogCategory $blogCategory
     * @return RedirectResponse
     */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        $request->validated();

        try {
            $blogCategory->fill([
                'name' => $request->input('name'),
                'icon' => $request->input('icon'),
                'status' => $request->input('status') ?? 0,
            ]);
            $blogCategory->save();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Blog Category has been updated successfully!'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogCategory $blogCategory
     * @return RedirectResponse
     */
    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        if ($blogCategory->blogs()->count()) {
            return redirect()
                ->back()
                ->with('message', CoreHelper::error('The category already used.'));
        }

        try {
            $blogCategory->delete();
            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Blog Category has been deleted successfully!'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }
}
