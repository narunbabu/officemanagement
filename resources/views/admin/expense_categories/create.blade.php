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
    <!--here we create form for new user-->
                {!! Form::Open(array('route' => 'expense_categories.store','method' => 'POST')) !!}
                @csrf
                <div class="panel panel-default">
                    <div class="panel-heading">
                        create
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('name', trans('Name').'*', ['class' => 'control-label']) !!}
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
                {!! Form::submit(trans('save'), ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
    </body>
</html>