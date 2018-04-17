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
    
                {!! Form::model($income_category, ['method' => 'PUT', 'route' => ['admin.income_categories.update', $income_category->id]]) !!}

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit
                    </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            {!! Form::label('name', trans('quickadmin.income-category.fields.name').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
        @include('layouts.javascripts')
    </body>
</html>
