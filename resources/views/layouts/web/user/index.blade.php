@extends('layouts/web/master_admin')
@section('pageTitle', 'View Users')
@section('content-subheader', 'List Users')
@section('main-content')
    @include ('flash::message')
	
	<table id="user" class="table table-bordred table-striped">
	    <thead>
<!--            	<th><input type="checkbox" id="checkall" /></th> -->
           	<th>No</th>
           	<th>User ID</th>
           	<th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Payment</th>
            <th>Expired</th>
            <th>Gender</th>
            <th>Verified</th>
            <th>Active</th>
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
				    <td>{{ $user->payment }}</td>
				    <td>{{ $user->expired_at }}</td>
				    <!-- Gender -->
		    		<td><img src="{{ $user->gender == '0' ? URL::asset('logo/female.png') : URL::asset('logo/male.png') }}" class="gender"/></td>
			    	
					<!-- Verified user or not -->
				    @if ($user->verified == '1')
				    	<td><input type="checkbox" disabled checked/></td>
				    @else 
				    	<td><input type="checkbox" disabled/></td>
				    @endif

				    <!-- Admin user or not -->
				    @if ($user->status == 'active')
				    	<td><input type="checkbox" disabled checked/></td>
				    @else 
				    	<td><input type="checkbox" disabled/></td>
				    @endif
				    <td>
				    	<p><a href="{{ route('view-update-users', ['id' => $user->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
				    	</td>
				    <td>
				    	@if(auth()->user()->admin == '2')
					    	<p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $user->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
					    @endif
				    </td>
				</tr>

				<!-- Delete Form -->
				<div class="modal fade" id="delete-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
				    <div class="modal-dialog">
				    	<div class="modal-content">
				          	<div class="modal-header">
				        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				        		<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
				      		</div>
					        <div class="modal-body">
					       		<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
					      	</div>
					        <div class="modal-footer ">
					        	<button type="button" class="btn btn-success" >
					        		<span class="glyphicon glyphicon-ok-sign"></span> Yes
					        	</button>
					        	<button type="button" class="btn btn-default" data-dismiss="modal">
					        		<span class="glyphicon glyphicon-remove"></span> No
					        	</button>
					      	</div>
				    	</div>
					</div>
				</div>
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
  //   if (performance.navigation.type == 1) {
		// document.getElementById("profile_image_show").value = "";
  //   } else {
		// document.getElementById("profile_image_show").value = "";
  //   }
    
	// document.getElementById('profile_image').onchange = uploadOnChange;

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