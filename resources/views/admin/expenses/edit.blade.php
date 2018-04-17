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
				<h2>Expense</h2><br>
                {!! Form::model($expense, ['method' => 'PUT', 'route' => ['admin.expenses.update', $expense->id], 'id' => 'expense']) !!}

                <div class="panel panel-default">
                    <div class="panel-heading">
                        edit
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('expense_category_id', trans('expense-category').'*', ['class' => 'control-label']) !!}
                                {!! Form::select('expense_category_id', $expense_categories, old('expense_category_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('expense_category_id'))
                                    <p class="help-block">
                                        {{ $errors->first('expense_category_id') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('entry_date', trans('entry-date').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('entry_date'))
                                    <p class="help-block">
                                        {{ $errors->first('entry_date') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('amount', trans('amount').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'id' => 'moneyFormat', 'placeholder' => '', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('amount'))
                                    <p class="help-block">
                                        {{ $errors->first('amount') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::submit(trans('update'), ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @include('layouts.javascripts')
    </body>
</html>

<!-- @section('javascript')-->
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });
    </script>