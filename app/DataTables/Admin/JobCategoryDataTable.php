<?php

namespace App\DataTables\Admin;

use App\Helpers\CoreHelper;
use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JobCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('icon', function (JobCategory $jobCategory) {
                $icon = $jobCategory->__get('icon');
                return "<i class=\"fa $icon\"></i>";
            })
            ->editColumn('status', function (JobCategory $jobCategory) {
                return CoreHelper::status($jobCategory->__get('status'));
            })
            ->addColumn('action', function (JobCategory $jobCategory) {
                return
                    CoreHelper::buttonView(route('admin.job-categories.show', $jobCategory->__get('id'))) .
                    CoreHelper::buttonEdit(route('admin.job-categories.edit', $jobCategory->__get('id'))) .
                    CoreHelper::buttonDelete(route('admin.job-categories.destroy', $jobCategory->__get('id')));
            })
            ->rawColumns(['icon', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(JobCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->drawCallback('function() {datatableCallback()}');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('slug'),
            Column::make('icon'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }
}
