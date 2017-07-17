@extends('layouts/web/master_admin')
@section('pageTitle', 'New Service Detail')
@section('content-subheader', 'Create new service detail')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-servicedetails') }}" method="post" role="form" enctype="multipart/form-data">
	       	{{ csrf_field() }}
	       	
            <div class="form-group {{ $errors->has('main_service_id') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Service Name <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
                  	<select id="main_service_id" name="main_service_id" class="form-control chosen-select mySelect" required>
                  		
                	@foreach($users as $user)
                     	<option value="{{ $user->id }}">{{ $user->full_name }} <span>{{ $user->email }}</span></option>
	                @endforeach

                  	</select>

	                @if ($errors->has('main_service_id'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('main_service_id') }}</strong>
		               	</span>
		           	@endif

                </div>	           	
            </div>

	       	<div class="form-group {{ $errors->has('ktp_image') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">KTP Photo <span class="asterisk">*</span></label>
                <div class="col-sm-7 col-sm-offset-1 form-style">
		            <input type="text" disabled="disabled" class="btn-up form-control" id="ktp_image_show" name="ktp_image_show" required>	
	            	<label for="ktp_image" class="btn-upload">Choose File</label>	            	
	                <input type="file" class="hidden" id="ktp_image" name="ktp_image" accept=".jpeg, .png, .jpg">

	                @if ($errors->has('ktp_image'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('ktp_image') }}</strong>
		               	</span>
		           	@endif	

                </div>
            </div>

            <div class="form-group {{ $errors->has('sim_image') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">SIM Photo <span class="asterisk">*</span></label>
                <div class="col-sm-7 col-sm-offset-1 form-style">
		            <input type="text" disabled="disabled" class="btn-up form-control" id="sim_image_show" name="sim_image_show" required>	
	            	<label for="sim_image" class="btn-upload">Choose File</label>	            	
	                <input type="file" class="hidden" id="sim_image" name="sim_image" accept=".jpeg, .png, .jpg">

	                @if ($errors->has('sim_image'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('sim_image') }}</strong>
		               	</span>
		           	@endif	
		           		                
                </div>
            </div>

            <div class="form-group {{ $errors->has('stnk_image') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">STNK Photo <span class="asterisk">*</span></label>
                <div class="col-sm-7 col-sm-offset-1 form-style">
		            <input type="text" disabled="disabled" class="btn-up form-control" id="stnk_image_show" name="stnk_image_show" required>	
	            	<label for="stnk_image" class="btn-upload">Choose File</label>	            	
	                <input type="file" class="hidden" id="stnk_image" name="stnk_image" accept=".jpeg, .png, .jpg">

	                @if ($errors->has('stnk_image'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('stnk_image') }}</strong>
		               	</span>
		           	@endif	
		           		                
                </div>
            </div>

            <div class="form-group {{ $errors->has('vehicle_image') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Vehicle Photo <span class="asterisk">*</span></label>
                <div class="col-sm-7 col-sm-offset-1 form-style">
		            <input type="text" disabled="disabled" class="btn-up form-control" id="vehicle_image_show" name="vehicle_image_show" required>	
	            	<label for="vehicle_image" class="btn-upload">Choose File</label>	            	
	                <input type="file" class="hidden" id="vehicle_image" name="vehicle_image" accept=".jpeg, .png, .jpg">

	                @if ($errors->has('vehicle_image'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('vehicle_image') }}</strong>
		               	</span>
		           	@endif	
		           		                
                </div>
            </div>

            <div class="form-group {{ $errors->has('license_platenumber') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Vehicle Platenumber <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="license_platenumber" class="form-control" placeholder="Vehicle Platenumber" required/>
		           	@if ($errors->has('license_platenumber'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('license_platenumber') }}</strong>
		               	</span>
		           	@endif	        	
	        	</div>	          
			</div>

			<div class="form-group {{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Vehicle Type <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="vehicle_type" class="form-control" placeholder="Vehicle Type" required/>
		           	@if ($errors->has('vehicle_type'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('vehicle_type') }}</strong>
		               	</span>
		           	@endif	        	
	        	</div>	          
			</div>

			<div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Category Type <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
                  	<select id="category_id" name="category_id" class="form-control chosen-select mySelect1" required>

                	@foreach($categories as $category)
                     	<option value="{{ $category->id }}">{{ $category->subcategory_type }}</option>
	                @endforeach

                  	</select>

	                @if ($errors->has('category_id'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('category_id') }}</strong>
		               	</span>
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
<script type="text/javascript">
	$('.mySelect').select2();
	$('.mySelect1').select2();

	document.getElementById('ktp_image').onchange = uploadOnChange;

	function uploadOnChange() {
	    var filename = this.value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('ktp_image_show').value = filename;
	}

	document.getElementById('sim_image').onchange = uploadOnChange1;

	function uploadOnChange1() {
	    var filename = this.value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('sim_image_show').value = filename;
	}

	document.getElementById('stnk_image').onchange = uploadOnChange2;

	function uploadOnChange2() {
	    var filename = this.value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('stnk_image_show').value = filename;
	}

	document.getElementById('vehicle_image').onchange = uploadOnChange3;

	function uploadOnChange3() {
	    var filename = this.value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('vehicle_image_show').value = filename;
	}
</script>
@endsection