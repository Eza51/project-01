<?php

namespace App\DataTables\Admin;

use App\Helpers\CoreHelper;
use App\Models\JobAttribute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JobAttributeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * 
     * mEssage <ADmin class="jobattribute index"></ADmin>
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('status', function (JobAttribute $jobAttribute) {
                return CoreHelper::status($jobAttribute->__get('status'));
            })
            ->addColumn('action', function (JobAttribute $jobAttribute) {
                return
                    CoreHelper::buttonView(route('admin.job-attributes.show', $jobAttribute->__get('id'))) .
                    CoreHelper::buttonEdit(route('admin.job-attributes.edit', $jobAttribute->__get('id'))) .
                    CoreHelper::buttonDelete(route('admin.job-attributes.destroy', $jobAttribute->__get('id')));
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        $model = JobAttribute::query()
            ->orderBy('type')
            ->orderBy('name');
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
            Column::make('type'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }
}
