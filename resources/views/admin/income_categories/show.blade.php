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
				<h2>Income Categories</h2><br>
                <a href="income_categories/create" class="btn btn-success">Add new</a>
                
                <div class="panel panel-default">
                    <div class="panel-heading">view</div>
                    <div class="panel-body table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>name</th>
                                        <td field-key='name'>{{ $income_category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>created-by</th>
                                        <td field-key='created_by'>{{ $income_category->created_by->name or '' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- Nav tabs -->
                        
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Income</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="income">
                                <table class="table table-bordered table-striped {{ count($incomes) > 0 ? 'datatable' : '' }}">
                                    <thead>
                                        <tr>
                                            <th>income-category</th>
                                            <th>entry-date</th>
                                            <th>amount</th>
                                            <th>created-by</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($incomes) > 0)
                                            @foreach ($incomes as $income)
                                                <tr data-entry-id="{{ $income->id }}">
                                                    <td field-key='income_category'>{{ $income->income_category->name or '' }}</td>
                                                    <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                                    <td field-key='amount'>{{ $income->amount }}</td>
                                                    <td field-key='created_by'>{{ $income->created_by->name or '' }}</td>
                                                    <td>
                                                        @can('view')
                                                        <a href="{{ route('incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">view</a>
                                                        @endcan
                                                        @can('edit')
                                                        <a href="{{ route('incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">edit</a>
                                                        @endcan
                                                        @can('delete')
                                                        {!! Form::open(array(
                                                            'style' => 'display: inline-block;',
                                                            'method' => 'DELETE',
                                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                            'route' => ['incomes.destroy', $income->id])) !!}
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
                        <p>&nbsp;</p>
                        <a href="#" class="btn btn-default">back_to_list</a>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.javascripts')
    </body>
</html>