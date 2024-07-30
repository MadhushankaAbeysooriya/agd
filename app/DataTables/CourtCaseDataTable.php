<?php

namespace App\DataTables;

use App\Models\CourtCase;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CourtCaseDataTable extends DataTable
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
            ->addColumn('action', function ($court_case) {
                $encryptedId = Crypt::encrypt($court_case->id);
                $btn = '';
                    $btn .= '<a href="'.route('court_cases.edit',$encryptedId).'"
                    class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pen-alt"></i> </a> ';

                    $btn .= '<a href="'.route('court_cases.show',$encryptedId).'"
                    class="btn btn-xs btn-secondary" data-toggle="tooltip" title="View">
                    <i class="fa fa-eye"></i> </a> ';

                    $btn .= '<a href="'.route('court_cases.assign_view',$encryptedId).'"
                    class="btn btn-xs btn-warning" data-toggle="tooltip" title="Assign">
                    <i class="fa fa-plus"></i> </a> ';

                return $btn;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CourtCase $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('courtcase-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderColumn(false)->width(40),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(80)
                  ->addClass('text-center'),
            Column::make('case_no')->data('case_no')->title('Case No'),
            Column::make('case_file_no')->data('case_file_no')->title('Case File No'),
            Column::make('title')->data('title')->title('Title'),
            Column::make('client_name')->data('client_name')->title('Client Name'),
            Column::make('started_date')->data('started_date')->title('Start Date'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CourtCase_' . date('YmdHis');
    }
}
