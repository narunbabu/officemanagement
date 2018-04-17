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
    </head>
	<body>
        <div id="wrapper" class="Index">
            @include('layouts.navbar')

            <div id="page-wrapper" class="gray-bg">
                @include('layouts.topnavbar')
				<h2>Incomes</h2><br>
				<a href="incomes/create" class="btn btn-success">Add new</a>
                    @can('income_create')
                        <p>
                            <a href="{{ route('admin.incomes.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
                            
                            @if(!is_null(Auth::getUser()->role_id) && config('quickadmin.can_see_all_records_role_id') == Auth::getUser()->role_id)
                                @if(Session::get('Income.filter', 'all') == 'my')
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
                            <table class="table table-bordered table-striped {{ count($incomes) > 0 ? 'datatable' : '' }} @can('income_delete') dt-select @endcan">
                                <thead>
                                    <tr>
                                        @can('income_delete')
                                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                        @endcan

                                        <th>income-category</th>
                                        <th>entry-date</th>
                                        <th>amount</th>
                                        <th>&nbsp;</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($incomes) > 0)
                                        @foreach ($incomes as $income)
                                            <tr data-entry-id="{{ $income->id }}">
                                                @can('income_delete')
                                                    <td></td>
                                                @endcan

                                                <td field-key='income_category'>{{ $income->income_category->name or '' }}</td>
                                                <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                                <td field-key='amount'>{{ $income->income_currency->symbol . ' ' . number_format($income->amount, 2, $income->income_currency->money_format_decimal, $income->income_currency->money_format_thousands) }}</td>
                                                <td>
                                                    @can('income_view')
                                                    <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                                    @endcan
                                                    @can('income_edit')
                                                    <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                                    @endcan
                                                    @can('income_delete')
                                                    {!! Form::open(array(
                                                        'style' => 'display: inline-block;',
                                                        'method' => 'DELETE',
                                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                        'route' => ['admin.incomes.destroy', $income->id])) !!}
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
        </div>
        @include('layouts.javascripts')
    </body>
</html>

<!-- @section('javascript')-->
    <script>
        @can('income_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.incomes.mass_destroy') }}';
        @endcan

    </script>