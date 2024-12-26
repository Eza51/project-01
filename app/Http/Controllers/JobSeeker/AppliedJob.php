<?php

namespace App\Http\Controllers\JobSeeker;

use App\DataTables\JobSeeker\AppliedJobDataTable;
use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Models\JobApply;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppliedJob extends Controller
{
    /**
     * @param AppliedJobDataTable $dataTable
     * @return mixed
     */
    public function index(AppliedJobDataTable $dataTable): mixed
    {
        return $dataTable->render('job_seeker.applied_job.index');
    }

    public function rating(Request $request)
    {
       
        $id = $request->input('id');
        $rating = (int) $request->input('rating');

        $error = null;

        if ($rating >= 1 && $rating <= 5) { //&& (logical AND) operator
            JobApply::query()
                ->where('id', $id)//yjra tble er input er sateh db er id mele
                ->update([
                    'rating' => $rating//then update rating column
                ]);
        } else {
            $error = 'Rating rage 1-5';
        }

        if ($error) {
            return redirect()
                ->route('job_seeker.applied_jobs.index')
                ->with('message', CoreHelper::error($error));
        } else {
            return redirect()
                ->route('job_seeker.applied_jobs.index')
                ->with('message', CoreHelper::success('Rating successfully'));
        }
    }
}
