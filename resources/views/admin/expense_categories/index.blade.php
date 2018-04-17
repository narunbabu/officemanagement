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

				<!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
        			<!-- Main content -->
        			<section class="content">
						@if(isset($siteTitle))
							<h3 class="page-title">
								{{ $siteTitle }}
							</h3>
						@endif

            			<div class="row">
							<div class="col-md-12">

								@if (Session::has('message'))
									<div class="alert alert-info">
										<p>{{ Session::get('message') }}</p>
									</div>
								@endif
								@if ($errors->count() > 0)
									<div class="alert alert-danger">
										<ul class="list-unstyled">
											@foreach($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif

							</div>
            			</div>
        			</section>
				</div>
				<h2>Expense Categories</h2><br>
				<a href="expense_categories/create" class="btn btn-success">Add new</a>
    				<!-- @can('expense_category_create')
    				<p>
        				<a href="#" class="btn btn-success">ADDNEW</a>
        
        				@if(!is_null(Auth::getUser()->role_id) && config('quickadmin.can_see_all_records_role_id') == Auth::getUser()->role_id)
            				@if(Session::get('ExpenseCategory.filter', 'all') == 'my')
                				<a href="?filter=all" class="btn btn-default">Show all records</a>
            				@else
                				<a href="?filter=my" class="btn btn-default">Filter my records</a>
            				@endif
        				@endif
    				</p>
    				 @endcan-->   <!--why it is not working -->

    				<div class="panel panel-default">
        				<div class="panel-heading">List</div>
						<div class="panel-body table-responsive">
            				<table class="table table-bordered table-striped {{ count($expense_categories) > 0 ? 'datatable' : '' }} @can('expense_category_delete') dt-select @endcan">
                				<thead>
                    				<tr>
                        				@can('expense_category_delete')
                            				<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        				@endcan
										<th>Name</th>
                        				<th>&nbsp;</th>
									</tr>
                				</thead>
                
                				<tbody>
                    				@if (count($expense_categories) > 0)
                        				@foreach ($expense_categories as $expense_category)
                            				<tr data-entry-id="{{ $expense_category->id }}">
                                				@can('expense_category_delete')
                                    				<td></td>
                                				@endcan

                                				<td field-key='name'>{{ $expense_category->name }}</td>
                                				<td>
                                    				@can('expense_category_view')
                                    					<a href="#" class="btn btn-xs btn-primary">VIEW</a>
                                    				@endcan
                                   					@can('expense_category_edit')
                                    					<a href="#" class="btn btn-xs btn-info">EDIT</a>
                                    				@endcan
                                    				@can('expense_category_delete')
													{!! Form::open(array(
                                        				'style' => 'display: inline-block;',
                                        				'method' => 'DELETE',
                                        				'onsubmit' => "return confirm('".trans("are_you_sure")."');",)); !!}
                            <!-- some code is missing here -->
                                    				{!! Form::submit(trans('delete'), array('class' => 'btn btn-xs btn-danger')) !!}
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
		</div>
		@include('layouts.javascripts')
		@include('layouts.footer')
	</body>
</html>


    <script>
        @can('expense_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.expense_categories.mass_destroy') }}';
        @endcan

    </script>