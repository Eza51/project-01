<?php

namespace App\DataTables\Admin;

use App\Helpers\CoreHelper;
use App\Models\Account;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AccountDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created', function (Account $account) {
                return Carbon::parse($account->__get('created_at'))->format('Y-m-d');
            })
            ->editColumn('avatar_image', function (Account $account) {
                $filename = $account->__get('avatar_image');
                return CoreHelper::accountAvatarImage($filename);
            })
            ->editColumn('jobs_count', function(Account $account) {
                if ($account->__get('account_type') == 'Job Seeker') {
                    return '<span class="badge badge-light">&#8211;</span>';
                }

                $url = route('admin.accounts.jobs', $account->__get('id'));

                return <<<HTML
                            <a href="$url" target="_blank" class="badge badge-light"><u>{$account->__get('jobs_count')}</u></a>
                        HTML;
            })
            ->editColumn('status', function (Account $account) {
                return CoreHelper::status($account->__get('status'), [
                    'Pending' => 'warning',
                    'Approved' => 'success',
                    'Suspended' => 'danger',
                ]);
            })
            ->addColumn('action', function (Account $account) {
                return
                    CoreHelper::buttonView(route('admin.accounts.show', $account->__get('id'))) .
                    CoreHelper::buttonEdit(route('admin.accounts.edit', $account->__get('id'))) .
                    CoreHelper::buttonDelete(route('admin.accounts.destroy', $account->__get('id')));
            })
            ->rawColumns(['avatar_image', 'jobs_count', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        $account = Account::query()->withCount('jobs');
        return $account->newQuery();
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
            ->drawCallback('function() {datatableCallback()}');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('created')->name('created_at'),
            Column::make('avatar_image')->title('image'),
            Column::make('name'),
            Column::make('email'),
            Column::make('username'),
            Column::make('account_type'),
            Column::make('status'),
            Column::make('jobs_count')
                ->title('Jobs')
                ->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }
}
