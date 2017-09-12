@extends('layouts/web/master_admin')
@section('pageTitle', 'View Users')
@section('content-subheader', 'List Users')
@section('main-content')
    <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-admins') }}"><span>  Add</span></a></div>

    @include ('flash::message')
	
	<table id="user" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>User ID</th>
           	<th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($users->currentPage() * $users->perPage()) - $users->perPage(); ?>
    		@foreach($users as $user)
		    	<tr>
				    <!-- <td><input type="checkbox" class="checkthis" /></td> -->
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $user->user_code }}</td>
				    <td>{{ $user->full_name }}</td>
				    <td>{{ $user->email }}</td>
				    <td>{{ $user->phone }}</td>
				    <!-- Gender -->
		    		<td><img src="{{ $user->gender == '0' ? URL::asset('logo/female.png') : URL::asset('logo/male.png') }}" class="gender"/></td>
			    	
				    <td>
				    	<p><a href="{{ route('view-update-admins', ['id' => $user->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
			    	</td>
			    	<td>
				    	@if(auth()->user()->admin == "2")
			    		<form method="POST" action="{{ route('delete-admins', ['id' => $user->id]) }}" role="form"> 
			    			{{ csrf_field() }}
			    			{{ method_field('DELETE') }}
				    		<p><button class="btn btn-danger btn-xs"><span  class="glyphicon glyphicon-trash"></span></button></p>
			    			}
			    		</form>
			    		@endif
			    	</td>
				</tr>

				<?php $i++; ?>
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $users->links() }}

	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	function uploadOnChange(id)
	{
		idNew = id.substring(13); 
	    filename = document.getElementById('profile_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('profile_image_show'+idNew).value = filename;
		document.getElementById('profile_image_show'+idNew).innerHTML = filename;
	}
</script>
@endsection