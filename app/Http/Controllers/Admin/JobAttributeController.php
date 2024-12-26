<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\JobAttributeDataTable;
use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobAttributeRequest;
use App\Http\Requests\Admin\UpdateJobAttributeRequest;
use App\Models\JobAttribute;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param JobAttributeDataTable $dataTable
     * @return mixed
     */
    public function index(JobAttributeDataTable $dataTable): mixed
    {
        return $dataTable->render('admin.job_attribute.index');//resouce file
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.job_attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobAttributeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreJobAttributeRequest $request): RedirectResponse
    {
        $request->validated();

        try {
            $jobAttribute = new JobAttribute();
            $jobAttribute->fill([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                //status home controller e 1 dewa
                'status' => $request->input('status') ?? 0,//??null operator by default null
                // if it exists and is not null.  null or does not exist, it defaults to 0.
            ]);
            $jobAttribute->save();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job Attribute has been created successfully!'));
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
     * @param JobAttribute $jobAttribute
     * @return View
     */
    public function show(JobAttribute $jobAttribute): View
    {
        return view('admin.job_attribute.show', compact('jobAttribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobAttribute $jobAttribute
     * @return View
     */
    public function edit(JobAttribute $jobAttribute): View
    {
        return view('admin.job_attribute.edit', compact('jobAttribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobAttributeRequest $request
     * @param JobAttribute $jobAttribute
     * @return RedirectResponse
     */
    public function update(UpdateJobAttributeRequest $request, JobAttribute $jobAttribute): RedirectResponse
    {
        $request->validated();

        try {
            $jobAttribute->fill([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'status' => $request->input('status') ?? 0,//??null operator by default null
            ]);
            $jobAttribute->save();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job Attribute has been updated successfully!'));
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
     * @param JobAttribute $jobAttribute
     * @return RedirectResponse
     */
    public function destroy(JobAttribute $jobAttribute): RedirectResponse
    {// Check if a job attribute ki database e ase//jobpostattribute table
        if ($jobAttribute->exist($jobAttribute->__get('id'))) {//jobpostattribute tble e jobatribute id exits
             // If exists, redirect back to the previous page
            return redirect()
                ->back()
                ->with('message', CoreHelper::error('The attribute already used.'));
        }

        try {
            $jobAttribute->delete();
            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job Attribute has been deleted successfully!'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }
}
