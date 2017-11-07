@extends('layouts/web/master_admin')
@section('pageTitle', 'New Service Detail')
@section('content-subheader', 'Create new service detail')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-servicedetails') }}" method="post" role="form" enctype="multipart/form-data" id="live_form">
	       	{{ csrf_field() }}
	       	
            <div class="form-group {{ $errors->has('main_service_id') ? ' has-error' : '' }}">
	            <input type="text" class="hidden" id="setting_mode" name="setting_mode" value="1">	
                <label class="col-sm-3 control-label">Service Name <span class="asterisk">*</span></label>
                <div class="col-sm-8 col-sm-offset-1 form-style">
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
            <div class="form-group">
	    		<label class="col-sm-3 control-label">Choose category service <span class="asterisk">*</span></label>
	    		<div class="col-sm-8 col-sm-offset-1 form-style funkyradio">
	    			@foreach($lists as $list)
	    			<div class="funkyradio-info radio-inline">
			            <input type="radio" name="category_type" id="category_type{{ $list[0]->category_type }}" value="{{ $list[0]->category_type }}"/>
			            <label for="category_type{{ $list[0]->category_type }}">{{ $list[0]->category_type }}</label>
			        </div>
			        @endforeach
			    </div>
			    @if ($errors->has('gender'))
			 	<span class="help-block">
			     	<strong>{{ $errors->first('gender') }}</strong>
			    	</span>
				@endif
			</div>
	       	<div class="form-group {{ $errors->has('ktp_image') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">KTP Photo <span class="asterisk">*</span></label>
                <div class="col-sm-7 col-sm-offset-1 form-style">
		            <input type="text" disabled="disabled" class="btn-up form-control" id="ktp_image_show" name="ktp_image_show" required>	
	            	<label for="ktp_image" class="btn btn-info">Choose File</label>	            	
	                <input type="file" class="hidden" id="ktp_image" name="ktp_image" accept=".jpeg, .png, .jpg" onchange="uploadOnChange('ktp_image')"/>

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
	            	<label for="sim_image" class="btn btn-info">Choose File</label>	            	
	                <input type="file" class="hidden" id="sim_image" name="sim_image" accept=".jpeg, .png, .jpg" onchange="uploadOnChange('sim_image')">

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
	            	<label for="stnk_image" class="btn btn-info">Choose File</label>	            	
	                <input type="file" class="hidden" id="stnk_image" name="stnk_image" accept=".jpeg, .png, .jpg" onchange="uploadOnChange('stnk_image')">

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
	            	<label for="vehicle_image" class="btn btn-info">Choose File</label>	            	
	                <input type="file" class="hidden" id="vehicle_image" name="vehicle_image" accept=".jpeg, .png, .jpg" onchange="uploadOnChange('vehicle_image')">

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
                <div class="col-sm-8 col-sm-offset-1 form-style">
                  	<select id="category_id" name="category_id" class="form-control chosen-select mySelect1" required>

                	@foreach($categories as $category)
                     	<option value="{{ $category->id }}">{{ $category->category_type }}<span> {{ $category->subcategory_type }}</span> </option>
	                @endforeach

                  	</select>

	                @if ($errors->has('category_id'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('category_id') }}</strong>
		               	</span>
		           	@endif

                </div>	           	
            </div>

            <div class="col-sm-8 col-sm-offset-3">
		       	<button class="btn btn-info btn-block custom-btn">
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

	function uploadOnChange(id) {
	    var filename = document.getElementById(id).value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById(id+'_show').value = filename;
	}

	// to reveal the hidden field based on category_type
	$(document).ready(function() {
		var filledIn = false;

		// Input radio 
		var category = $('input:radio[name=category_type]');

		// Choose with fields to visible
		var simImage = $('input:text[name=sim_image_show]');

		// When category change, choose which one to open
		category.change(function(){ 
			var value=this.value;						
			all.addClass('hidden'); 
			
			if (value == 'Taksi' || value == 'Ojek' || value == 'Bajaj' || value == 'Bentor' || value == 'Bemo'){
				simImage.removeClass('hidden');
			}
			else if (value == 'Abang'){
				// sim.removeClass('hidden'); //show feedback_ok	
			}		
			// else if (value == 'Excellent'){
			// 	testimonial_parent.removeClass('hidden'); //show testimonial question
				
			// 	//if testimonial has already been answered
			// 	if (testimonial_ok == 'yes'){great.removeClass('hidden');} 
			// 	else if (testimonial_ok == 'no'){thanks_anyway.removeClass('hidden');}
			// }
		});	
	});
</script>
@endsection