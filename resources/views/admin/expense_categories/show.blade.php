<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>expense categories</title>
        
        @include('layouts.css')
        @include('layouts.js')
    
    </head>
    <body>
        <div id="wrapper" class="Index">
            @include('layouts.navbar')

            <div id="page-wrapper" class="gray-bg">
                @include('layouts.topnavbar')
                <h2>Expense Categories</h2>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        view
                    </div>

                    <div class="panel-body table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>name</th>
                                            <td field-key='name'>{{ $expense_category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>created-by</th>
                                            <td field-key='created_by'>{{ $expense_category->created_by->name or '' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Expenses</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="expense">
                                <table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }}">
                                    <thead>
                                        <tr>
                                            <th>expense-category</th>
                                            <th>entry-date</th>
                                            <th>amount</th>
                                            <th>created-by</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($expenses) > 0)
                                            @foreach ($expenses as $expense)
                                                <tr data-entry-id="{{ $expense->id }}">
                                                    <td field-key='expense_category'>{{ $expense->expense_category->name or '' }}</td>
                                                    <td field-key='entry_date'>{{ $expense->entry_date }}</td>
                                                    <td field-key='amount'>{{ $expense->amount }}</td>
                                                    <td field-key='created_by'>{{ $expense->created_by->name or '' }}</td>
                                                    <td>
                                                        @can('view')
                                                        <a href="{{ route('expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">view</a>
                                                        @endcan
                                                        @can('edit')
                                                        <a href="{{ route('expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">edit</a>
                                                        @endcan
                                                        @can('delete')
                                                        {!! Form::open(array(
                                                            'style' => 'display: inline-block;',
                                                            'method' => 'DELETE',
                                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                            'route' => ['expenses.destroy', $expense->id])) !!}
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
                        <a href="{{ route('admin.expense_categories.index') }}" class="btn btn-default">back_to_list</a>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.javascripts')
    </body>
</html>