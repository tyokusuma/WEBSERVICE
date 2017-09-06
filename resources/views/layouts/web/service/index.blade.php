@extends('layouts/web/master_admin')
@section('pageTitle', 'View Services Detail')
@section('content-subheader', 'List Services Detail')
@section('main-content')
    @include ('flash::message')
	
	<div id="service" class="rTable">
	    <div class="rTableHead">
           	<div class="rTableCell"><b>No</b></div>
            <div class="rTableCell"><b>Profile Image</b></div>
            <div class="rTableCell"><b>Full Name</b></div>
            <div class="rTableCell"><b>Email</b></div>
            <div class="rTableCell"><b>Gender</b></div>
            <div class="rTableCell"><b>Phone</b></div>
            <div class="rTableCell"><b>Category Service</b></div>
            <div class="rTableCell"><b>Verified</b></div>
            <div class="rTableCell"><b>Suspend</b></div>
            <div class="rTableCell"><b>Edit</b></div>
            <div class="rTableCell"><b>Delete</b></div>
            <div class="rTableCell"><b></b></div>
            <div class="rTableCell"></div>
        </div>
        	<?php $i = 1; $skipped = ($servicedetails->currentPage() * $servicedetails->perPage()) - $servicedetails->perPage(); ?>
	    	@foreach($servicedetails as $servicedetail)
	    	<div class="rTableBody">	
	    		<div class="rTableCell">{{ $skipped + $i }}</div>
	    		<div class="rTableCell"><img class="pp" src="{{ URL::asset('img/'.$servicedetail->profile_image) }}" alt="{{ $servicedetail->profile_image }}"/></div>
	    		<div class="rTableCell">{{ $servicedetail->full_name }}</div>
	    		<div class="rTableCell">{{ $servicedetail->email }}</div>
	    		@if ($servicedetail->gender == '0')
		    		<div class="rTableCell"><img src="{{ URL::asset('logo/female.png') }}" class="gender"/></div>
		    	@else 
		    		<div class="rTableCell"><img src="{{ URL::asset('logo/male.png') }}" class="gender"/></div>
		    	@endif
	    		<div class="rTableCell">{{ $servicedetail->phone }}</div>
			    <div class="rTableCell">{{ $servicedetail->service->category->category_type }}</div>
	    		@if ($servicedetail->verified == '1')
			    	<div class="rTableCell"><input type="checkbox" disabled checked/></div>
			    @else 
			    	<div class="rTableCell"><input type="checkbox" disabled/></div>
			    @endif
			    @if ($servicedetail->service->status == '0')
			    	<div class="rTableCell"><input type="checkbox" disabled checked/></div>
			    @else 
			    	<div class="rTableCell"><input type="checkbox" disabled/></div>
			    @endif
	    		<div class="rTableCell">
	    			<p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit{{ $servicedetail->id }}" ><span class="glyphicon glyphicon-pencil"></span></button></p>	
	    		</div>
	    		<div class="rTableCell">
	    			<p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete{{ $servicedetail->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
	    		</div>
	    		<div class="rTableCell">
	    			<p>
	    			@if($servicedetail->service->status == '0')
	    				<form action="{{ route('suspend-service', ['id' => $servicedetail->service->id]) }}" role="form" method="POST">
	    					{{ csrf_field() }}
	    					{{ method_field('PATCH') }}
	    					<input type="text" class="hidden" name="status" value="1" />
	    					<button clas="btn btn-info btn-xs"><span>Activate</span></button>
	    				</form>
	    			@else
	    				<form action="{{ route('suspend-service', ['id' => $servicedetail->service->id]) }}" role="form" method="POST">
	    					{{ csrf_field() }}
	    					{{ method_field('PATCH') }}
	    					<input type="text" class="hidden" name="status" value="0" />
	    					<button clas="btn btn-info btn-xs"><span>Suspend</span></button>
	    				</form>
	    			@endif
	    			</p>
	    		</div>
			@if($servicedetail->service->ktp_image != null)
		    <div class="rTableCell">
		    	<a href="{{ route('get-images', [ 'id' => $servicedetail->service->id, 'sim' => $servicedetail->service->sim_image, 'ktp' => $servicedetail->service->ktp_image, 'stnk' => $servicedetail->service->stnk_image, 'vehicle' => $servicedetail->service->vehicle_image ]) }}">View Detail Images</a>
		    </div>
		    @endif
		    </div>

			<!-- Form edit -->
			@if(Session::get('error_code'))
	    		<script>
	    		// alert('This is so annoying');
	    			$("#edit-5").modal('show');
	    		</script>
	    	@endif
			<div class="modal fade" id="edit{{ $servicedetail->id }}" role="dialog" aria-labelledby="edit" aria-hidden="true">
			    <div class="modal-dialog">
			    	<div class="modal-content">
						<form action="{{ route('update-servicedetails', ['id' => $servicedetail->id]) }}" id="update{{ $servicedetail->id }}" method="post" role="form" enctype="multipart/form-data">	
						{{ csrf_field() }}
				       	{{ method_field('PATCH') }}	
				    		<input class="form-control hidden" type="text" name="id" value="{{ $servicedetail->id }}" disabled>    	
				        	<div class="modal-header">
				        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				        		</button>
				        		<h4 class="modal-title custom_align" id="Heading">Edit Service Detail</h4>
				      		</div>
				        	<div class="modal-body">
				        	<div class="separator">

				          		<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
					        		<label>Service Name</label>
				        			<input class="form-control" type="text" name="full_name" value="{{ $servicedetail->full_name }}">
			        				@if ($errors->has('full_name'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('full_name') }}</strong>
			        			    	</span>
			        				@endif	   
				        		</div>
					        	<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">        
					        		<label>Email</label>
				        			<input class="form-control" type="text" name="email" value="{{ $servicedetail->email }}">
				        			@if ($errors->has('email'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('email') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        		<div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
					        		<label>Phone Number</label>				        		
				        			<input class="form-control" type="text" name="phone" value="{{ $servicedetail->phone }}">
				        			@if ($errors->has('phone'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('phone') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        		<div class="form-group {{ $errors->has('profile_image') ? ' has-error' : '' }}">
					        		<label>Profile Image</label>
				        			<div>
	        				            <input type="text" class="btn-up form-control" id="profile_image_show{{ $servicedetail->id }}" name="profile_image_show" placeholder="{{ $servicedetail->profile_image }}" disabled>
	        			            	<label for="profile_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
	    			                </div>
	    			                @if ($errors->has('profile_image'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('profile_image') }}</strong>
			        			    	</span>
			        				@endif
	        			                <input type="file" class="hidden" onchange="uploadOnChange(this.id)" id="profile_image{{ $servicedetail->id }}" name="profile_image" accept=".jpeg, .png, .jpg">
				        		</div>
				        		<div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
					        		<label>Gender</label>
					        		<span class="funkyradio">
					        			<div class="funkyradio-info radio-inline">
			        			            <input type="radio" name="gender" id="female{{ $servicedetail->id }}" value="0" <?php echo $servicedetail->gender == '0' ? 'checked' : '' ?>/>
			        			            <label for="female{{ $servicedetail->id }}">Female</label>
			        			        </div>
			        			        <div class="funkyradio-info radio-inline"> 
			        			            <input type="radio" name="gender" id="male{{ $servicedetail->id }}" value="1" <?php echo $servicedetail->gender == '1' ? 'checked' : '' ?>/>
			        			            <label for="male{{ $servicedetail->id }}">Male</label>
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
			        			            	<input type="checkbox" name="admin" id="admin{{ $servicedetail->id }}" value="1" <?php echo $servicedetail->admin == '1' ? 'checked' : '' ?>/>
			        			            	<label for="admin{{ $servicedetail->id }}" disabled>Admin</label>
			        			        	</div>
			        			    </span>
			        			    @if ($errors->has('admin'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('admin') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        		<div class="form-group {{ $errors->has('verified') ? ' has-error' : '' }}">
					        		<label>Verified Email</label>
				        			<span class="funkyradio">
			        					<div class="funkyradio-primary radio-inline">
		        			            	<input type="checkbox" name="verified" id="verified{{ $servicedetail->id }}" {{ $servicedetail->verified == '1' ? 'checked="checked" ' : '' }}/>
		        			            	<label for="verified{{ $servicedetail->id }}">Verified</label>
		        			        	</div>					        				
			        			    </span>
			        			    @if ($errors->has('verified'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('verified') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        	</div>
				       		<!-- ************************************************************************************************ -->
				       		<!-- BAGIAN YANG SERVICE -->
				        	<div>
	    		          		<div class="form-group {{ $errors->has('main_service_id') ? ' has-error' : '' }}">
	    			        		<label>Main Service ID</label>
	    		        			<input class="form-control" type="text" name="main_service_id" value="{{ $servicedetail->service->main_service_id }}">
	    	        				<!-- @if ($errors->has('full_name'))
	    	        			 	<span class="help-block">
	    	        			     	<strong>{{ $errors->first('full_name') }}</strong>
	    	        			    	</span>
	    	        				@endif -->	   
	    		        		</div>
	    		          		<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
	    			        		<label>Service ID</label>
	    		        			<input class="form-control" type="text" name="service_id" value="{{ $servicedetail->service->id }}">
	    	        				<!-- @if ($errors->has('full_name'))
	    	        			 	<span class="help-block">
	    	        			     	<strong>{{ $errors->first('full_name') }}</strong>
	    	        			    	</span>
	    	        				@endif -->	   
	    		        		</div>
				        		<div class="form-group {{ $errors->has('ktp_image') ? ' has-error' : '' }}">
					        		<label>KTP Image</label>
				        			<div>
	        				            <input type="text" class="btn-up form-control" id="ktp_image_show{{ $servicedetail->id }}" name="ktp_image_show" placeholder="{{ $servicedetail->service->ktp_image }}" disabled>
	        			            	<label for="ktp_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
	    			                </div>
	    			                @if ($errors->has('ktp_image'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('ktp_image') }}</strong>
			        			    	</span>
			        				@endif
	        			                <input type="file" class="hidden" onchange="uploadOnChange1(this.id)" id="ktp_image{{ $servicedetail->id }}" name="ktp_image" accept=".jpeg, .png, .jpg">
				        		</div>
				        		<div class="form-group {{ $errors->has('sim_image') ? ' has-error' : '' }}">
					        		<label>SIM Image</label>
				        			<div>
	        				            <input type="text" class="btn-up form-control" id="sim_image_show{{ $servicedetail->id }}" name="sim_image_show" placeholder="{{ $servicedetail->service->sim_image }}" disabled>
	        			            	<label for="sim_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
	    			                </div>
	    			                @if ($errors->has('sim_image'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('sim_image') }}</strong>
			        			    	</span>
			        				@endif
	        			                <input type="file" class="hidden" onchange="uploadOnChange2(this.id)" id="sim_image{{ $servicedetail->id }}" name="sim_image" accept=".jpeg, .png, .jpg">
				        		</div>
				        		<div class="form-group {{ $errors->has('stnk_image') ? ' has-error' : '' }}">
					        		<label>STNK Image</label>
				        			<div>
	        				            <input type="text" class="btn-up form-control" id="stnk_image_show{{ $servicedetail->id }}" name="stnk_image_show" placeholder="{{ $servicedetail->service->stnk_image }}" disabled>
	        			            	<label for="stnk_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
	    			                </div>
	    			                @if ($errors->has('stnk_image'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('stnk_image') }}</strong>
			        			    	</span>
			        				@endif
	        			                <input type="file" class="hidden" onchange="uploadOnChange3(this.id)" id="stnk_image{{ $servicedetail->id }}" name="stnk_image" accept=".jpeg, .png, .jpg">
				        		</div>
				        		<div class="form-group {{ $errors->has('vehicle_image') ? ' has-error' : '' }}">
					        		<label>Vehicle Image</label>
				        			<div>
	        				            <input type="text" class="btn-up form-control" id="vehicle_image_show{{ $servicedetail->id }}" name="vehicle_image_show" placeholder="{{ $servicedetail->service->vehicle_image }}" disabled>
	        			            	<label for="vehicle_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
	    			                </div>
	    			                @if ($errors->has('vehicle_image'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('vehicle_image') }}</strong>
			        			    	</span>
			        				@endif
	        			                <input type="file" class="hidden" onchange="uploadOnChange4(this.id)" id="vehicle_image{{ $servicedetail->id }}" name="vehicle_image" accept=".jpeg, .png, .jpg">
				        		</div>
				        		<div class="form-group {{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
					        		<label>Vehicle Type</label>				        		
				        			<input class="form-control" type="text" name="vehicle_type" value="{{ $servicedetail->service->vehicle_type }}">
				        			@if ($errors->has('vehicle_type'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('vehicle_type') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        		<div class="form-group {{ $errors->has('license_platenumber') ? ' has-error' : '' }}">
					        		<label>License Plate Number</label>				        		
				        			<input class="form-control" type="text" name="license_platenumber" value="{{ $servicedetail->service->license_platenumber }}">
				        			@if ($errors->has('license_platenumber'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('license_platenumber') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        		<div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
					        		<label class="spasi">Category</label>
				        			<select id="category_id" name="category_id" class="form-control chosen-select mySelect" style="margin-left: 1%; width:50%;" placeholder="{{ $servicedetail->service->subcategory_type }}" required>
				                  		
				                	@foreach($categories as $category)
				                     	<option value="{{ $category->id }}">{{ $category->category_type }} <span>{{ $category->subcategory_type }}</span></option>
					                @endforeach

				                  	</select>

			        			    @if ($errors->has('category_id'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('category_id') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        		<div class="form-group {{ $errors->has('verified_service') ? ' has-error' : '' }}">
					        		<label>Verified Service</label>
				        			<span class="funkyradio">
			        					<div class="funkyradio-primary radio-inline">
		        			            	<input type="checkbox" name="verified_service" id="verified_service{{ $servicedetail->id }}" {{ $servicedetail->service->verified_service == '1' ? 'checked="checked" ' : '' }}/>
		        			            	<label for="verified_service{{ $servicedetail->id }}">Verified</label>
		        			        	</div>					        				
			        			    </span>
			        			    @if ($errors->has('verified_service'))
			        			 	<span class="help-block">
			        			     	<strong>{{ $errors->first('verified_service') }}</strong>
			        			    	</span>
			        				@endif
				        		</div>
				        	</div>
				      		</div>

				          	<div class="modal-footer ">
				        		<button type="submit" form="update{{ $servicedetail->id }}" class="btn btn-warning btn-lg btn-update"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
				      			<input type="hidden" name="action" value="update{{ $servicedetail->id }}" />
				      		</div>
				        </div>
				  	</div>    
				</div>
			</form>

			<!-- Form delete -->
			<div class="modal fade" id="delete{{ $servicedetail->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
				        		<span class="glyphicon glyphicon-ok-sign"></span>Yes
				        	</button>
				        	<button type="button" class="btn btn-default" data-dismiss="modal">
				        		<span class="glyphicon glyphicon-remove"></span>No
				        	</button>
				      	</div>
			    	</div>
				</div>
			</div>
			<?php $i++; ?>
			@endforeach
		</div>

	<!-- Pagination -->
	{{ $servicedetails->links() }}

	@include('layouts.web.partials.footer')
	
@endsection

@section('script')
<script type="text/javascript">
	$('.mySelect').select2();

	window.addEventListener("load", function(event) {
    	// alert("All resources finished loading!");
  	});

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

	function uploadOnChange1(id)
	{
		idNew = id.substring(9); 
	    filename = document.getElementById('ktp_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('ktp_image_show'+idNew).value = filename;
		document.getElementById('ktp_image_show'+idNew).innerHTML = filename;
	}

	function uploadOnChange2(id)
	{
		idNew = id.substring(9); 
	    filename = document.getElementById('sim_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('sim_image_show'+idNew).value = filename;
		document.getElementById('sim_image_show'+idNew).innerHTML = filename;
	}

	function uploadOnChange3(id)
	{
		idNew = id.substring(10); 
	    filename = document.getElementById('stnk_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('stnk_image_show'+idNew).value = filename;
		document.getElementById('stnk_image_show'+idNew).innerHTML = filename;
	}

	function uploadOnChange4(id)
	{
		idNew = id.substring(13); 
	    filename = document.getElementById('vehicle_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('vehicle_image_show'+idNew).value = filename;
		document.getElementById('vehicle_image_show'+idNew).innerHTML = filename;
	}

	$('input[type="checkbox"]').click(function () {
    	$(this).prop("checked") ? $(this).val("1") : $(this).val("0");
	});
</script>
@endsection