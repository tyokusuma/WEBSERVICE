@extends('layouts/web/master_admin')
@section('pageTitle', 'View Users')
@section('content-subheader', 'List Users')
@section('main-content')
    @include ('flash::message')
	
	<table id="user" class="table table-bordred table-striped">
	    <thead>
<!--            	<th><input type="checkbox" id="checkall" /></th> -->
           	<th>ID</th>
           	<th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Verified</th>
            <th>Admin</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
    	<tbody>	
    		@foreach($users as $user)
		    	<tr>
				    <!-- <td><input type="checkbox" class="checkthis" /></td> -->
				    <td>{{ $user->id }}</td>
				    <td>{{ $user->full_name }}</td>
				    <td>{{ $user->email }}</td>
				    <td>{{ $user->phone }}</td>
				    
				    <!-- Gender -->
			    	@if ($user->gender == '0')
			    		<td><img src="{{ URL::asset('logo/female.png') }}" style="width: 32; height: 32;"/></td>
			    	@else 
			    		<td><img src="{{ URL::asset('logo/male.png') }}" style="width: 32; height: 32;"/></td>
			    	@endif
				    
					<!-- Verified user or not -->
				    @if ($user->verified == '1')
				    	<td><input type="checkbox" disabled checked/></td>
				    @else 
				    	<td><input type="checkbox" disabled/></td>
				    @endif

				    <!-- Admin user or not -->
				    @if ($user->admin == '1')
				    	<td><input type="checkbox" disabled checked/></td>
				    @else 
				    	<td><input type="checkbox" disabled/></td>
				    @endif
				    <td><p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit-{{ $user->id }}"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
				    <td><p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $user->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
				</tr>

				<!-- Edit Form -->
				<form action="{{ route('update-users', ['id' => $user->id]) }}" id="update{{ $user->id }}" method="post" role="form" enctype="multipart/form-data">
	       		{{ csrf_field() }}
		       	{{ method_field('PATCH') }}
					<div class="modal fade" id="edit-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
						    	@if(Session::get('error_code'))
						    		<script>
						    		// alert('This is so annoying');
						    			$("#edit-5").modal('show');
						    		</script>
						    	@endif
					    		<input class="form-control hidden" type="text" name="id" value="{{ $user->id }}" disabled>
					        	<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        		</button>
					        		<h4 class="modal-title custom_align" id="Heading">Edit User</h4>
					      		</div>
					        	<div class="modal-body">
					          		<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
						        		<label>Full Name</label>
					        			<input class="form-control" type="text" name="full_name" value="{{ $user->full_name }}">
				        				@if ($errors->has('full_name'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('full_name') }}</strong>
				        			    	</span>
				        				@endif	   
					        		</div>
						        	<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">        
						        		<label>Email</label>
					        			<input class="form-control" type="text" name="email" value="{{ $user->email }}">
					        			@if ($errors->has('email'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('email') }}</strong>
				        			    	</span>
				        				@endif
					        		</div>
					        		<div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
						        		<label>Phone Number</label>				        		
					        			<input class="form-control" type="text" name="phone" value="{{ $user->phone }}">
					        			@if ($errors->has('phone'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('phone') }}</strong>
				        			    	</span>
				        				@endif
					        		</div>
					        		<div class="form-group {{ $errors->has('profile_image') ? ' has-error' : '' }}">
						        		<label>Profile Image</label>
					        			<div>
		        				            <input type="text" class="btn-up form-control" id="profile_image_show{{ $user->id }}" name="profile_image_show" disabled>
		        			            	<label for="profile_image{{ $user->id }}" class="btn-upload">Choose File</label>
	        			                </div>
	        			                @if ($errors->has('profile_image'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('profile_image') }}</strong>
				        			    	</span>
				        				@endif
		        			                <input type="file" class="hidden" onchange="uploadOnChange(this.id)" id="profile_image{{ $user->id }}" name="profile_image" accept=".jpeg, .png, .jpg">
					        		</div>
					        		<div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
						        		<label>Gender</label>
						        		<span class="funkyradio">
						        			<div class="funkyradio-info radio-inline">
				        			            <input type="radio" name="gender" id="female{{ $user->id }}" value="0" <?php echo $user->gender == '0' ? 'checked' : '' ?>/>
				        			            <label for="female{{ $user->id }}">Female</label>
				        			        </div>
				        			        <div class="funkyradio-info radio-inline"> 
				        			            <input type="radio" name="gender" id="male{{ $user->id }}" value="1" <?php echo $user->gender == '1' ? 'checked' : '' ?>/>
				        			            <label for="male{{ $user->id }}">Male</label>
				        			        </div>
				        			    </span>
				        			    @if ($errors->has('gender'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('gender') }}</strong>
				        			    	</span>
				        				@endif
					        		</div>
					        		<div class="form-group {{ $errors->has('admin') ? ' has-error' : '' }}">
						        		<label>Admin</label>
					        			<span class="funkyradio">
					        				<input type="hidden" name="admin" value="0">
					        					<div class="funkyradio-primary radio-inline">
				        			            	<input type="checkbox" name="admin" id="admin{{ $user->id }}" value="1" <?php echo $user->admin == '1' ? 'checked' : '' ?>/>
				        			            	<label for="admin{{ $user->id }}">Admin</label>
				        			        	</div>
				        			    </span>
				        			    @if ($errors->has('admin'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('admin') }}</strong>
				        			    	</span>
				        				@endif
					        		</div>
					        		<div class="form-group {{ $errors->has('verified') ? ' has-error' : '' }}">
						        		<label>Verified Account</label>
					        			<span class="funkyradio">
				        					<div class="funkyradio-primary radio-inline">
				        						@if($user->verified == '1')
			        			            		<input type="checkbox" name="verified" id="verified{{ $user->id }}" value="1" checked/>
			        			            	@else
			        			            		<input type="checkbox" name="verified" id="verified{{ $user->id }}" value="0"/>		        			            	
			        			            	@endif
			        			            	<label for="verified{{ $user->id }}">Verified</label>
			        			        	</div>					        				
				        			    </span>
				        			    @if ($errors->has('verified'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('verified') }}</strong>
				        			    	</span>
				        				@endif
					        		</div>
					      		</div>
					          	<div class="modal-footer ">
					        		<button type="submit" form="update{{ $user->id }}" class="btn btn-warning btn-lg btn-update"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
					      			<input type="hidden" name="action" value="update{{ $user->id }}" />
					      		</div>
					        </div>
					  	</div>    
					</div>
				</form>

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