<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Admin</title>

        @include('layouts.css')
        @include('layouts.js')
    </head>

    <body>
        <div id="wrapper" class="Index">
            @include('layouts.navbar')

            <div id="page-wrapper" class="gray-bg">
                @include('layouts.topnavbar')
                <center>
                    <table class="table table-hover table-bordered">
					    <tr>
					    	<th>Name</th>
							<th>Username</th>
					        <th>Position</th>
					        <th>Email</th>
					        <th>Operation</th>
					    </tr>
					    <tbody id="myTable">
					        @foreach ($users as $user)
					            <tr>
					            	<td>
					                    {{ $user->name }}
					                </td>
					                <td>
					                    {{ $user->username }}
					                </td>
					                <td>
					                    {{ $user->position }}
					                </td>
					                <td>
					                    {{ $user->email }}
					                </td>
					                <td>
										<a href="/admin/employee/details/{{ $user->id }}">Details</a> |
					                 
					                    <a href="/admin/employee/edit/{{ $user->id }}">Edit</a> | 
					                
					                    <a href="/admin/employee/delete/{{ $user->id }}">Delete</a>
					                </td>
					            </tr>
					        @endforeach
					    </tbody>
					</table>
					<br>
					<button class="btn btn-info block m-b" onclick="exportTableToCSV('users.csv')">Export To CSV File</button>
                </center>
            </div>
        </div>

        @include('layouts.footer')
    </body>
</html>

<script>
	$(document).ready(function () {
	    $("#myInput").on("keyup", function () {
	        var value = $(this).val().toLowerCase();
	        $("#myTable tr").filter(function () {
	            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	        });
	    });
	});
</script>