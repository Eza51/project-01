<?php

namespace App\DataTables\Admin;

use App\Helpers\CoreHelper;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BlogCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('status', function (BlogCategory $blogCategory) {
                return CoreHelper::status($blogCategory->__get('status'));
            })
            ->addColumn('action', function (BlogCategory $blogCategory) {
                return
                    CoreHelper::buttonView(route('admin.blog-categories.show', $blogCategory->__get('id'))) .
                    CoreHelper::buttonEdit(route('admin.blog-categories.edit', $blogCategory->__get('id'))) .
                    CoreHelper::buttonDelete(route('admin.blog-categories.destroy', $blogCategory->__get('id')));
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BlogCategory $model): QueryBuilder
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
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }
}
