<?php

namespace App\Http\Controllers\Employer;

use App\DataTables\Employer\JobApplyDataTable;
use App\DataTables\Employer\JobDataTable;
use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\StoreJobRequest;
use App\Http\Requests\Employer\UpdateJobRequest;
use App\Mail\JobApplyStatus;
use App\Models\Account;
use App\Models\JobApply;
use App\Models\JobAttribute;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\JobPostAttribute;
use App\Models\JobPostAttributeOther;
use App\Models\JobPostLocation;
use App\Models\JobPostSalary;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

// EmPLOyer ADminPannel JOb
/**__construct(): Sets authenticated user details using middleware.
 * 
index(): Renders a DataTable for job listings.

create(): Displays form for creating new job posts.

store(): Handles storing new job posts in the database.

show(): Displays details of a specific job post.

edit(): Displays form for editing a job post.

update(): Handles updating an existing job post.

destroy(): Deletes a job post from the database if no applies

applies(): Renders DataTable for job applications under a specific job post.

applyDelete(): Deletes a job application.

jobSeeker(): Displays details of a job seeker's profile.

applyUpdate(): Updates status and interview details of a job application.

compactData(): Prepares data needed for job creation and editing forms. */

class JobController extends Controller
{
    private int $accountId;//variable stores the ID of the authenticated user 
    private Authenticatable|null $account;//holds user object (Authenticatable instance) of the authenticated user.
//constructor achieves this by using middleware
    public function __construct()
    {
        // middleware function captures the ID authenticated user using the 'account' guard.
        $this->middleware(function($request, $next) {
            $this->accountId = Auth::guard('account')->id();//guard name account..we create
            $this->account = Auth::guard('account')->user();
            return $next($request);//intended controller action
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(JobDataTable $dataTable)
    {
        return $dataTable->render('employer.job.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('employer.job.create', $this->compactData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            // Table job_posts
            $jobPost = new JobPost();
            // Filling attributes from an array
            $jobPost->fill([
                'account_id' => $this->accountId,
                'job_category_id' => $request->input('job_category_id'),
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
                'vacancy' => $request->input('vacancy'),
                'deadline' => $request->input('deadline'),
                'status' => 'Pending',
            ]);
            $jobPost->save();

            $jobPostId = $jobPost->__get('id');//jobPostId value ney id er

            // Table job_post_locations
            $jobPostLocation = new JobPostLocation();
            // Filling attributes from an array
            $jobPostLocation->fill([
                'job_post_id' => $jobPostId,
                'country_id' => $request->input('country_id'),
                'state_id' => $request->input('state_id'),
                'city_id' => $request->input('city_id'),
                'address' => $request->input('address'),
            ]);
            $jobPostLocation->save();

            // Table job_post_salaries
            $jobPostSalary = new JobPostSalary();
            $jobPostSalary->fill([
                'job_post_id' => $jobPostId,
                'min_salary' => $request->input('min_salary'),
                'max_salary' => $request->input('max_salary'),
            ]);
            $jobPostSalary->save();//update db

            $jobAttributes = $request->input('job_attributes');//if ipnut insnot empty
            if (!empty($jobAttributes)) {
                foreach ($jobAttributes as $jobAttributeId) {
                    // Create a new JobPostAttribute instance
                    $jobPostAttribute = new JobPostAttribute();
                    $jobPostAttribute->fill([//array fill
                        'job_post_id' => $jobPostId,
                        'job_attribute_id' => $jobAttributeId
                    ]);
                    $jobPostAttribute->save();
                }
            }

            // Table job_post_attribute_others
            $jobPostAttributeOther= new JobPostAttributeOther();
            $jobPostAttributeOther->fill([
                'job_post_id' => $jobPostId,
                'tags' => $request->input('tags'),
                'benefits' => $request->input('benefits'),
                'skills' => $request->input('skills'),
            ]);
            $jobPostAttributeOther->save();
            //success hole dbcommit or rollback

            DB::commit();//changes permanent in the database 

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job post has been created successfully!'));
        } catch (Exception $exception) {
            DB::rollBack();
           // rollback (undo) database operations 

            return redirect()
                ->back()
                ->withInput()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }

    /**
     * @param JobPost $jobPost
     * @return View
     * @throws AuthorizationException
     */
    public function show(JobPost $jobPost): View
    {
        Gate::forUser($this->account)->authorize('view', $jobPost);
        //gate autoriztn method check jobpolicy...autized hole futher exucte

        $data = $this->compactData();//compactData() method initial data rendering the view.
//$jobPost model has defined relationships with these entities.
        $data['jobPost'] = $jobPost->load([
            'category',
            'account',
            'attributes',
            'attributeOther',
            'location',
            'salary'
        ]);

        return view('employer.job.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobPost $jobPost
     * @return View
     * @throws AuthorizationException
     */
    public function edit(JobPost $jobPost): View
    {
        Gate::forUser($this->account)->authorize('update', $jobPost);
//gate autoriztn method check jobpolicy...autized hole futher exucte
        $data = $this->compactData();//cmptdata mtd rending viwe

        $data['jobPost'] = $jobPost->load([
            'category',
            'account',
            'attributes',
            'attributeOther',
            'location',
            'salary'
        ]);

        return view('employer.job.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobRequest $request
     * @param JobPost $jobPost
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateJobRequest $request, JobPost $jobPost): RedirectResponse
    {
        Gate::forUser($this->account)->authorize('update', $jobPost);
//gate autoriztn method check jobpolicy...autized hole futher exucte
        $request->validated();

        try {
            DB::beginTransaction();//tnsc start

            $jobPostId = $jobPost->__get('id');

            // Delete
            JobPostLocation::query()->where('job_post_id', $jobPostId)->delete();
            JobPostSalary::query()->where('job_post_id', $jobPostId)->delete();
            JobPostAttribute::query()->where('job_post_id', $jobPostId)->delete();
            JobPostAttributeOther::query()->where('job_post_id', $jobPostId)->delete();

            // Table job_posts
            $jobPost->fill([
                'job_category_id' => $request->input('job_category_id'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'vacancy' => $request->input('vacancy'),
                'deadline' => $request->input('deadline'),
            ]);
            $jobPost->save();

            // Table job_post_locations
            $jobPostLocation = new JobPostLocation();
            $jobPostLocation->fill([
                'job_post_id' => $jobPostId,
                'country_id' => $request->input('country_id'),
                'state_id' => $request->input('state_id'),
                'city_id' => $request->input('city_id'),
                'address' => $request->input('address'),
            ]);
            $jobPostLocation->save();

            // Table job_post_salaries
            $jobPostSalary = new JobPostSalary();
            $jobPostSalary->fill([
                'job_post_id' => $jobPostId,
                'min_salary' => $request->input('min_salary'),
                'max_salary' => $request->input('max_salary'),
            ]);
            $jobPostSalary->save();

            $jobAttributes = $request->input('job_attributes');
            if (!empty($jobAttributes)) {
                foreach ($jobAttributes as $jobAttributeId) {
                    // Table job_post_attributes
                    $jobPostAttribute = new JobPostAttribute();
                    $jobPostAttribute->fill([
                        'job_post_id' => $jobPostId,
                        'job_attribute_id' => $jobAttributeId
                    ]);
                    $jobPostAttribute->save();
                }
            }

            // Table job_post_attribute_others
            $jobPostAttributeOther= new JobPostAttributeOther();
            $jobPostAttributeOther->fill([
                'job_post_id' => $jobPostId,
                'tags' => $request->input('tags'),
                'benefits' => $request->input('benefits'),
                'skills' => $request->input('skills'),
            ]);
            $jobPostAttributeOther->save();

            DB::commit();

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job post has been updated successfully!'));
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JobPost $jobPost
     * @return RedirectResponse
     */
    public function destroy(JobPost $jobPost): RedirectResponse
    {
        if ($jobPost->jobApplies()->count()) { //JobPost model e jobapplies function call kore
            return redirect()
                ->back()
                ->with('message', CoreHelper::error('Already applies under the job post.'));
        }

        try {
            $jobPost->delete();
            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Job post has been deleted successfully!'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }

    /**
     * @param JobPost $jobPost
     * @return mixed
     */
    public function applies(JobPost $jobPost): mixed
    { 
        // Check if the job post's account_id matches the current user's account_id
        
        if ($jobPost->__get('account_id') !== $this->accountId) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED');
        }

        // Initialize DataTable for job applies
        $dataTable = new JobApplyDataTable($jobPost->__get('id'));
        
    // Render the view with the DataTable
        return $dataTable->render('employer.job.applies');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function applyDelete(int $id): RedirectResponse
    {
        // Check exist
        JobApply::query()
            ->where('id', '=', $id)
            ->firstOrFail()->delete();

        return redirect()
            ->back()
            ->with('message', CoreHelper::success('Job applies has been deleted successfully'));
    }

    /**
     * @param Account $account
     * @return View
     */
    public function jobSeeker(Account $account): View
    {
        $account = $account->load(['address', 'educations', 'experiences']);

        return view('employer.job.job_seeker', compact('account'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function applyUpdate(Request $request): RedirectResponse
    {
        try {
            // Check Auth Verification basically taking jobapply Id in $jobappy
            $jobApply = JobApply::with(['jobPost', 'account'])
                ->whereHas('jobPost', function($query) {//wherehas Orm modl-qry
                    $query->where('account_id', $this->accountId);//whre mtch cndtn..qry-tble
                   
            
            
                    //je emplyer update krtese tr undr e ai job seekr ase kna mtch   
                    
                    
                   //accnt_id=424 r sthe kon job post aasocisted spps 20
                })
                //job_apply id=423 kon job post associated spps 20
                ->where('id', $request->input('job_apply_id'))//
                ->first();//JobApply records find one id matching value provided $request object's job_apply_id input.

            if (!$jobApply) {
                throw new Exception('Invalid your request.');//thrw excptn statement in PHP
            }

            // status Update
            JobApply::query()
                ->where('id', $request->input('job_apply_id'))//jobapply id nisse
                ->update([
                    'interview_date' => $request->input('interview_date') ?? null,//??php oprtr dflt vle null
                    'status' => $request->input('status'),//jpapply table stattus update
                ]);

            $from = CoreHelper::getSetting('SETTING_EMAIL_CONFIG_EMAIL_ADDRESS');
            $siteTitle = CoreHelper::getSetting('SETTING_SITE_TITLE');


            $data = [
                'site_title' => $siteTitle,
                'from' => $from,
                'subject' => 'Job Apply Notification Status',
                'job_apply' => $jobApply,
                'status' =>  $request->input('status'),
                'interview_date' => $request->input('interview_date'),
            ];

            Mail::to($jobApply->account->email)->send(new JobApplyStatus($data));

            return redirect()
                ->back()
                ->with('message', CoreHelper::success('Saved successfully'));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('message', $exception->getMessage());
        }
    }

    /**
     * @return array
     */
    private function compactData(): array
    {
        $jobCategories = JobCategory::query()
            ->where('status', '=', 1)
            ->orderBy('name')
            ->get();

        $jobAttributes = JobAttribute::query()
            ->where('status', '=', 1)
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return compact('jobCategories', 'jobAttributes');
    }

    /**
     * @return array
     */
    private function compactData2(): array
    {
        $employerAccounts = Account::query()
            ->where('account_type', '=', 'Employer')
            ->where('status', '=', 'Approved')
            ->orderBy('name')
            ->get();

        $jobCategories = JobCategory::query()
            ->where('status', '=', 1)
            ->orderBy('name')
            ->get();

        $jobAttributes = JobAttribute::query()
            ->where('status', '=', 1)
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return compact('employerAccounts', 'jobCategories', 'jobAttributes');
    }


}
