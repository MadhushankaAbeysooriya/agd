<?php

namespace App\DataTables;

use App\Models\LoginDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LoginDetailDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('hospital', function ($loginDetail) {
                $userHospital = $loginDetail->user->userhospital;
                if($userHospital)
                {
                    return $userHospital->hospital->name;
                }else
                {
                    return 'N/A';
                }                
            })
            ->addColumn('district', function ($loginDetail) {
                $userHospital = $loginDetail->user->userhospital;
                if($userHospital)
                {
                    return $userHospital->hospital->district->name;
                }else
                {
                    return 'N/A';
                }                
            })
            ->rawColumns(['hospital','district']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LoginDetail $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('logindetail-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([                        
                        Button::make('pdf'),
                        Button::make('print'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [            
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderColumn(false)->width(40),
            Column::make('user.name')->data('user.name')->title('Name'),
            Column::make('login_ip')->data('login_ip')->title('Login IP'),
            Column::make('hospital')->data('hospital')->title('Hospital'),
            Column::make('district')->data('district')->title('District'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LoginDetail_' . date('YmdHis');
    }
}
