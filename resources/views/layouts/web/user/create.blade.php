@extends('layouts/web/master_admin')
@section('pageTitle', 'New User')
@section('content-subheader', 'Create new user')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-users') }}" method="post" role="form" enctype="multipart/form-data">
	       	{{ csrf_field() }}
	       	
	       	<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Full Name <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="full_name" class="form-control" placeholder="Full Name" required autofocus/>
		           	@if ($errors->has('full_name'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('full_name') }}</strong>
		               	</span>
		           	@endif	        		
	        	</div>		           

			</div>	

	       	<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">E-mail <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="email" name="email" class="form-control" placeholder="Email" required/>
		           	@if ($errors->has('email'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('email') }}</strong>
		               	</span>
		           	@endif	        	
	        	</div>	          
			</div>

	       	<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Password <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	           		<input type="password" name="password" class="form-control" placeholder="Password" required/>
		          	@if ($errors->has('password'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('password') }}</strong>
		               	</span>
		           	@endif
	           	</div>
	       	</div>

	       	<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	       	    <label class="col-sm-3 control-label">Confirm Password <span class="asterisk">*</span></label>
	       	    <div class="col-sm-7 col-sm-offset-1 form-style">
	       	        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required/>
	       	    </div>
		       	    @if ($errors->has('password_confirmation'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('password_confirmation') }}</strong>
		               	</span>
		           	@endif	
	       	</div>

	       	<div class="form-group {{ $errors->has('profile_image') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Profile Image <span class="asterisk">*</span></label>
                <div class="col-sm-7 col-sm-offset-1 form-style">
		            <input type="text" disabled="disabled" class="btn-up form-control" id="profile_image_show" name="profile_image_show" required>	
	            	<label for="profile_image" class="btn-upload" >Choose File</label>	            	
	                <input type="file" class="hidden" id="profile_image" name="profile_image" accept=".jpeg, .png, .jpg">
	                @if ($errors->has('profile_image'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('profile_image') }}</strong>
		               	</span>
		           	@endif		                
                </div>
            </div>

            <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Gender <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
                  	<select id="gender" name="gender" class="form-control chosen-select" required>
                     	<option value="0">Female</option>
                     	<option value="1">Male</option>
                  	</select>
	                @if ($errors->has('gender'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('admin') }}</strong>
		               	</span>
		           	@endif
                </div>	           	
            </div>

	       	<div class="form-group {{ $errors->has('admin') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Type <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
                  	<select id="admin" name="admin" class="form-control chosen-select" required>
                     	<option value="0">Regular User</option>
                     	<option value="1">Admin</option>
                  	</select>
	                @if ($errors->has('admin'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('admin') }}</strong>
		               	</span>
		           	@endif
                </div>
            </div>

			<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Phone Number <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="phone" class="form-control" placeholder="Phone Number" required/>
		           	@if ($errors->has('phone'))
		            	<div class="help-block">
		                	<strong>{{ $errors->first('phone') }}</strong>
		               	</div>
		           	@endif	        	
	        	</div>		           
			</div>

            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-success btn-block">
		           Register
		       	</button>
		       	<input type="hidden" name="action" value="register" />
	       	</div>
	   		</form>
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	if (window.performance) {
	  console.info("window.performance work's fine on this browser");
	}

    if (performance.navigation.type == 1) {
		document.getElementById("profile_image_show").value = "";
    } else {
		document.getElementById("profile_image_show").value = "";
    }
    
	document.getElementById('profile_image').onchange = uploadOnChange;

	function uploadOnChange() {
	    var filename = this.value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('profile_image_show').value = filename;
	}
</script>
@endsection