<?php

namespace App\DataTables\JobSeeker;

use App\Helpers\ConstantHelper;
use App\Helpers\CoreHelper;
use App\Models\JobApply;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AppliedJobDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('employer', function(JobApply $jobApply) {
                $account = $jobApply->__get('jobPost')->__get('account');
                $address = $account->__get('address');

                $image = CoreHelper::accountAvatarImage($account->avatar_image);
                $name = $account->__get('name');
                $url = route('account.employer', $account->__get('id'));

                $parts = [];
                if ($city = $address->__get('city')) {
                    $parts[] = $city->name;
                }
                if ($state = $address->__get('state')) {
                    $parts[] = $state->name;
                }
                if ($country = $address->__get('country')) {
                    $parts[] = $country->iso2;
                }

                $addressText = implode(', ', $parts);

                $addressText = $address->__get('address') . "<br>" . $addressText;

                return <<<HTML
                        <div class="d-flex">
                            <div>$image</div>
                            <div class="ml-2">
                                <a href="$url" target="_blank"><u><b>$name</b></u></a>
                                <small class="d-block">$addressText</small>
                            </div>
                        </div>
                        HTML;
            })
            ->editColumn('salary', function(JobApply $jobApply) {
                $jobPost = $jobApply->__get('jobPost');

                $salaryObj = $jobPost->__get('salary');
                $attributeObjs = $jobPost->__get('attributes');


                $currency = ConstantHelper::CURRENCY;
                $minSalary = $salaryObj->__get('min_salary');
                $maxSalary = $salaryObj->__get('max_salary');

                if ($maxSalary) {
                    $salary = number_format($minSalary) . ' - ' . number_format($maxSalary);
                } else {
                    $salary = number_format($minSalary);
                }

                $attributeObj = $attributeObjs->first(function ($attributeObj) {
                    return $attributeObj->attribute->type === 'Salary Type';
                });
                $salaryType = $attributeObj ? $attributeObj->attribute->name : '-';

                return  "$salary $currency<br><small>$salaryType</small>";
            })
            //JObseeker Interview date in jobseeker dashboard
            ->editColumn('status', function (JobApply $jobApply) {

                $status = CoreHelper::status($jobApply->__get('status'), [
                    'Submitted' => 'warning',
                    'Under Review' => 'info',
                    'Shortlisted' => 'secondary',
                    'Interview Scheduled' => 'light',
                    'Rejected' => 'danger',
                    'Withdrawn' => 'danger',
                    'Hired' => 'success',
                ]);
//trtotime() function PHP dtetme cnvrt Unix timestamp
                $interview_date = date('d F Y h:i A', strtotime($jobApply->__get('interview_date')));
//f txtual mothn jnry..y 2024..i i: Minutes with leading zeros (00 to 59)...A..AM Pm
                if ($jobApply->__get('status') == 'Interview Scheduled') {
                    return "$status <br><small>$interview_date</small>";
                } else {
                    return $status;
                }
            })
            ->editColumn('applied', function(JobApply $jobApply) {
                return Carbon::make($jobApply->__get('created_at'))->format('Y-m-d h:i A')
                    . "<br><small>" . CoreHelper::timeAgo($jobApply->__get('created_at')) . "</small>";
            })
            ->addColumn('action', function (JobApply $jobApply) {
                $slug = $jobApply->__get('jobPost')->slug;
                $id = $jobApply->__get('id');
                $ratingUrl = route('job_seeker.applied_jobs.rating');//rating url web.php to controoler
                $rating = $jobApply->__get('rating');
                //https://example.com/rate?id=123&rating=

                $url = route('job_seeker.chat.index', $id);
  
                $html = "<a href=\"javascript:void(0);\" class=\"btn btn-icon btn-sm btn-warning\" onClick=\"let rating = prompt('Enter a review', '5'); if (rating !== null) { window.location.href = '$ratingUrl?id=$id&rating=' + encodeURIComponent(rating); }\" title=\"Chat\"><i class=\"fa fa-star\">$rating</i></a>";
                
                // Chat Button
                $html .= "<a href=\"$url\" class=\"btn btn-icon btn-sm btn-info ml-1\" title=\"Chat\"><i class=\"fa fa-comment\"></i></a>";
                $html .= CoreHelper::buttonView(route('jobs.detail', $slug), false, '_blank');
                return $html;
            })
            ->rawColumns(['employer', 'salary', 'deadline', 'applied', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        $accountId = Auth::guard('account')->id();

        return JobApply::with([
            'jobPost',
        ])
            ->where('account_id', $accountId)
            ->orderByDesc('created_at')
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->drawCallback('function() {
                datatableCallback();
            }');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('employer')->name('job_post_id')->search(true),
            Column::make('job_post.title')->name('job_post_id')->title('Job Title')->searchable(true),
            Column::make('salary')->name('job_post_id')->title('Salary'),
            Column::make('applied')->name('job_post_id')->title('applied'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }
}
