@extends('layouts/web/master_admin')
@section('pageTitle', 'View Users')
@section('content-subheader', 'Update Users')
@section('main-content')
	<div class="contentpanel cs_df">
	    @include ('flash::message')
		<div class="row">
	   			<form action="{{ route('update-users', ['id' => $user->id]) }}" method="post" role="form" enctype="multipart/form-data">
		       	{{ csrf_field() }}
		       	{{ method_field('PATCH') }}
		       	<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
	              	<label class="col-sm-3 control-label">Full Name <span class="asterisk">*</span></label>
	              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" required/>
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
		        		<input type="email" name="email" class="form-control" value="{{ $user->email }}" required/>
			           	@if ($errors->has('email'))
			            	<span class="help-block">
			                	<strong>{{ $errors->first('email') }}</strong>
			               	</span>
			           	@endif	        	
		        	</div>	          
				</div>

		       	<!-- <div class="form-group {{ $errors->has('profile_image') ? ' has-error' : '' }}">
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
	            </div> -->

	            <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
	                <label class="col-sm-3 control-label">Gender <span class="asterisk">*</span></label>
	                <div class="col-sm-6 col-sm-offset-1 form-style">
	                  	<span class="funkyradio">
		        			<div class="funkyradio-info radio-inline">
        			            <input type="radio" name="gender" id="female{{ $user->id }}" value="0" {{ $user->gender == '0' ? 'checked' : ''}}/>
        			            <label for="female{{ $user->id }}">Female</label>
        			        </div>
        			        <div class="funkyradio-info radio-inline"> 
        			            <input type="radio" name="gender" id="male{{ $user->id }}" value="1" {{ $user->gender == '1' ? 'checked' : ''}}/>
        			            <label for="male{{ $user->id }}">Male</label>
        			        </div>
        			    </span>
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
	                  	<span class="funkyradio">
		        			<div class="funkyradio-info radio-inline">
        			            <input type="radio" name="admin" id="admin-reg" value="0" {{ $user->admin == '0' ? 'checked' : ''}}/>
        			            <label for="admin-reg">Regular User</label>
        			        </div>
        			        <div class="funkyradio-info radio-inline"> 
        			            <input type="radio" name="admin" id="admin-adm" value="1" {{ $user->admin == '1' ? 'checked' : ''}}/>
        			            <label for="admin-adm">Admin</label>
        			        </div>
        			        <div class="funkyradio-info radio-inline"> 
        			            <input type="radio" name="admin" id="admin-spr" value="2" {{ $user->admin == '2' ? 'checked' : ''}} {{ auth()->user()->admin != '2' ? 'disabled' : ''}}/>
        			            <label for="admin-spr">Superadmin</label>
        			        </div>
        			    </span>
		                @if ($errors->has('admin'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('admin') }}</strong>
			               	</span>
			           	@endif
	                </div>
	            </div>

        		<div class="form-group {{ $errors->has('verified') ? ' has-error' : '' }}">
	        		<label class="col-sm-3 control-label">Verified Account <span class="asterisk">*</span></label>
	                <div class="col-sm-6 col-sm-offset-1 form-style">
	        			<span class="funkyradio">
	    					<div class="funkyradio-info radio-inline">
	    						@if($user->verified == '1')
				            		<input type="checkbox" name="verified" id="verified{{ $user->id }}" value="1" checked/>
				            		<input id='Hidden' type='hidden' value='0' name='verified'>
				            	@else
				            		<input type="checkbox" name="verified" id="verified{{ $user->id }}" value="0"/>		        			
				            		<input id='Hidden' type='hidden' value='1' name='verified'>
				            	@endif
				            	<label for="verified{{ $user->id }}">Verified</label>
				        	</div>					        				
	    			    </span>
	    			</div>
    			    @if ($errors->has('verified'))
    			 	<span class="help-block">
    			     	<strong>{{ $errors->first('verified') }}</strong>
    			    	</span>
    				@endif
        		</div>

        		<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
	        		<label class="col-sm-3 control-label">Status Account <span class="asterisk">*</span></label>
	                <div class="col-sm-6 col-sm-offset-1 form-style">
	        			<span class="funkyradio">
	    					<div class="funkyradio-info radio-inline">
	    						@if($user->status == 'active')
				            		<input type="checkbox" name="status" id="status{{ $user->id }}" value="1" checked/>
				            		<input id='Hidden' type='hidden' value='0' name='status'>
				            	@else
				            		<input type="checkbox" name="status" id="status{{ $user->id }}" value="0"/>		        			
				            		<input id='Hidden' type='hidden' value='1' name='status'>
				            	@endif
				            	<label for="status{{ $user->id }}">Active</label>
				        	</div>					        				
	    			    </span>
	    			</div>
    			    @if ($errors->has('status'))
    			 	<span class="help-block">
    			     	<strong>{{ $errors->first('status') }}</strong>
    			    	</span>
    				@endif
        		</div>

				<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	              	<label class="col-sm-3 control-label">Phone Number <span class="asterisk">*</span></label>
	              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required/>
			           	@if ($errors->has('phone'))
			            	<div class="help-block">
			                	<strong>{{ $errors->first('phone') }}</strong>
			               	</div>
			           	@endif	        	
		        	</div>		           
				</div>

				<div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
	              	<label class="col-sm-3 control-label">City <span class="asterisk">*</span></label>
	              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        		<select name="city_id" class="form-control mySelect" placeholder="{{ $user->city->name_city }}" required/>
		        			@foreach($cities as $index => $city)
		               		<option value="{{ $index }}">{{ $city->name_city }}</option>
		               		@endforeach
		            	</select>
			           	@if ($errors->has('city_id'))
			            	<div class="help-block">
			                	<strong>{{ $errors->first('city_id') }}</strong>
			               	</div>
			           	@endif	        	
		        	</div>		           
				</div>

				<div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
	              	<label class="col-sm-3 control-label">Payment <span class="asterisk">*</span></label>
	              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        		<select name="payment" class="form-control"/>
		        			<option selected disabled hidden>{{ $user->payment }}</option>
		               		<option value="full">Full Payment</option>
		               		<option value="year">Year Payment</option>
		            	</select>
			           	@if ($errors->has('payment'))
			            	<div class="help-block">
			                	<strong>{{ $errors->first('payment') }}</strong>
			               	</div>
			           	@endif	        	
		        	</div>		           
				</div>

	            <div class="col-sm-6 col-sm-offset-3">
			       	<button class="btn btn-info btn-block custom-btn">
			           Update
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
	$('.mySelect').select2();

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