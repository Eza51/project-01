<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\JobCategoryDataTable;
use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobCategoryRequest;
use App\Http\Requests\Admin\UpdateJobCategoryRequest;
use App\Models\JobCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param JobCategoryDataTable $dataTable
     * @return mixed
     */
    public function index(JobCategoryDataTable $dataTable): mixed
    {
        return $dataTable->render('admin.job_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.job_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreJobCategoryRequest $request): RedirectResponse
    {
        $request->validated();

        try {
            $jobCategory = new JobCategory();
            $jobCategory->fill([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'icon' => $request->input('icon'),
                'status' => $request->input('status') ?? 0,
            ]);
            $jobCategory->save();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job Category has been created successfully!'));
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
     * @param JobCategory $jobCategory
     * @return View
     */
    public function show(JobCategory $jobCategory): View
    {
        return view('admin.job_category.show', compact('jobCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobCategory $jobCategory
     * @return View
     */
    public function edit(JobCategory $jobCategory): View
    {
        return view('admin.job_category.edit', compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobCategoryRequest $request
     * @param JobCategory $jobCategory
     * @return RedirectResponse
     */
    public function update(UpdateJobCategoryRequest $request, JobCategory $jobCategory): RedirectResponse
    {
        $request->validated();

        try {
            $jobCategory->fill([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'icon' => $request->input('icon'),
                'status' => $request->input('status') ?? 0,
            ]);
            $jobCategory->save();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job Category has been updated successfully!'));
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
     * @param JobCategory $jobCategory
     * @return RedirectResponse
     */
    public function destroy(JobCategory $jobCategory): RedirectResponse
    {
        // Get the name of the job category from the jobCategory object
        $name = $jobCategory->__get('name');
// JObCategor model...e JObpost relation e ase...jobs function e...
//jobs e giye...jobpost theke ki ki category ase dekhe
        if ($jobCategory->jobs()->count()) {
         
            return redirect()
                ->back()
                ->with('message', CoreHelper::error("<b>$name</b> category name already used."));
        }

        try {
            $jobCategory->delete();
            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job Category has been deleted successfully!'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }
}
