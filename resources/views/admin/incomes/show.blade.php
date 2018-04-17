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
                <h3 class="page-title">@lang('quickadmin.income.title')</h3>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        @lang('quickadmin.qa_view')
                    </div>

                    <div class="panel-body table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>@lang('quickadmin.income.fields.income-category')</th>
                                    <td field-key='income_category'>{{ $income->income_category->name or '' }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('quickadmin.income.fields.entry-date')</th>
                                    <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('quickadmin.income.fields.amount')</th>
                                    <td field-key='amount'>{{ $income->income_currency->symbol . ' ' . number_format($income->amount, 2, $income->income_currency->money_format_decimal, $income->income_currency->money_format_thousands) }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('quickadmin.income.fields.created-by')</th>
                                    <td field-key='created_by'>{{ $income->created_by->name or '' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <p>&nbsp;</p>

                    <a href="{{ route('admin.incomes.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
                </div>
            </div>
        </div>
        @include('layouts.javascripts')
    </body>
</html>