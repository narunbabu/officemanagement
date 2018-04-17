<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Admin</title>
		<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
		<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
        @include('layouts.css')
        @include('layouts.js')
        <!-- @include('layouts.javascripts') -->
    </head>
	<body>
        <div id="wrapper" class="Index">
            @include('layouts.navbar')

            <div id="page-wrapper" class="gray-bg">
                @include('layouts.topnavbar')
				<h2>Expense</h2><br>
                <a href="expenses/create" class="btn btn-success">Add new</a>
                @can('expense_create')
                <p>
                    <a href="#" class="btn btn-success">Add new</a>
                    
                    @if(!is_null(Auth::getUser()->role_id) && config('quickadmin.can_see_all_records_role_id') == Auth::getUser()->role_id)
                        @if(Session::get('Expense.filter', 'all') == 'my')
                            <a href="?filter=all" class="btn btn-default">Show all records</a>
                        @else
                            <a href="?filter=my" class="btn btn-default">Filter my records</a>
                        @endif
                    @endif
                </p>
                @endcan

                <div class="panel panel-default">
                    <div class="panel-heading">
                        list
                    </div>

                    <div class="panel-body table-responsive">
                        <table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }} @can('expense_delete') dt-select @endcan">
                            <thead>
                                <tr>
                                    @can('expense_delete')
                                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                    @endcan

                                    <th>expense-category</th>
                                    <th>entry-date</th>
                                    <th>amount</th>
                                    <th>&nbsp;</th>

                                </tr>
                            </thead>
                
                            <tbody>
                                @if (count($expenses) > 0)
                                    @foreach ($expenses as $expense)
                                        <tr data-entry-id="{{ $expense->id }}">
                                            @can('expense_delete')
                                                <td></td>
                                            @endcan

                                            <td field-key='expense_category'>{{ $expense->expense_category->name or '' }}</td>
                                            <td field-key='entry_date'>{{ $expense->entry_date }}</td>
                                            <td field-key='amount'>{{ $expense->expense_currency->symbol  . ' ' . number_format($expense->amount, 2, $expense->expense_currency->money_format_decimal, $expense->expense_currency->money_format_thousands) }}</td>
                                            <td>
                                                @can('expense_view')
                                                <a href="{{ route('admin.expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                                @endcan
                                                @can('expense_edit')
                                                <a href="{{ route('admin.expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                                @endcan
                                                @can('expense_delete')
            {!! Form::open(array(
                                                    'style' => 'display: inline-block;',
                                                    'method' => 'DELETE',
                                                    'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                    'route' => ['admin.expenses.destroy', $expense->id])) !!}
                                                {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                                {!! Form::close() !!}
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">no_entries_in_table</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.javascripts')
    </body>
</html>

    <script>
        @can('expense_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.expenses.mass_destroy') }}';
        @endcan

    </script>