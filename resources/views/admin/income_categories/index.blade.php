<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Admin</title>
		<link rel="stylesheet"
      href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
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
                    <!-- @can('income_category_create')
                    <p>
                        <a href="#" class="btn btn-success">add new</a>
                    </p>
                    @endcan --> <!--it is not working-->
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        list
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-bordered table-striped {{ count($income_categories) > 0 ? 'datatable' : '' }} @can('income_category_delete') dt-select @endcan">
                            <thead>
                                <tr>
                                    @can('income_category_delete')
                                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                    @endcan

                                    <th>name</th>
                                    <th>&nbsp;</th>

                                </tr>
                            </thead>
                
                            <tbody>
                                @if (count($income_categories) > 0)
                                    @foreach ($income_categories as $income_category)
                                        <tr data-entry-id="{{ $income_category->id }}">
                                            @can('income_category_delete')
                                                <td></td>
                                            @endcan

                                            <td field-key='name'>{{ $income_category->name }}</td>
                                            <td>
                                                @can('income_category_view')
                                                <a href="{{ route('admin.income_categories.show',[$income_category->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                                @endcan
                                                @can('income_category_edit')
                                                <a href="{{ route('admin.income_categories.edit',[$income_category->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                                @endcan
                                                @can('income_category_delete')
                                                {!! Form::open(array(
                                                    'style' => 'display: inline-block;',
                                                    'method' => 'DELETE',
                                                    'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                    'route' => ['admin.income_categories.destroy', $income_category->id])) !!}
                                                {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                                {!! Form::close() !!}
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">no_entries_in_table</td>
                                    </tr>
                                @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.javascripts')
    </body>
</html>

<!-- @section('javascript')-->
    <script>
        @can('income_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.income_categories.mass_destroy') }}';
        @endcan

    </script>