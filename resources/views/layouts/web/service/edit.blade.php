@extends('layouts/web/master_admin')
@section('pageTitle', 'Edit Province')
@section('content-subheader', 'Edit province')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('update-provinces', ['id' => $province->id]) }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	{{ method_field('PATCH') }}
	       	<div class="form-group {{ $errors->has('name_province') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Name Province <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="name_province" class="form-control" placeholder="Province Name" required value="{{ $province->name_province }}"/>
		           	@if ($errors->has('name_province'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('name_province') }}</strong>
		               	</span>
		           	@endif	        		
	        	</div>		           
			</div>	
            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-warning btn-block custom-btn">
		           Update
		       	</button>
		       	<input type="hidden" name="action" value="update" />
	       	</div>
	   		</form>

	   		<form action="{{ route('update-servicedetails', ['id' => $servicedetail->id]) }}" id="update{{ $servicedetail->id }}" method="post" role="form" enctype="multipart/form-data">	
			{{ csrf_field() }}
	       	{{ method_field('PATCH') }}	
	    		

	          		<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Service Name</label>
		              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        			<input class="form-control" type="text" name="full_name" value="{{ $servicedetail->full_name }}">
	        				@if ($errors->has('full_name'))
	        			 	<span class="help-block">
	        			     	<strong>{{ $errors->first('full_name') }}</strong>
	        			    	</span>
	        				@endif	   
	        			</div>
	        		</div>
		        	<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">        
		        		<label class="col-sm-3 control-label">Email</label>
		              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        			<input class="form-control" type="text" name="email" value="{{ $servicedetail->email }}">
		        			@if ($errors->has('email'))
	        			 	<span class="help-block">
	        			     	<strong>{{ $errors->first('email') }}</strong>
	        			    	</span>
	        				@endif
	        			</div>
	        		</div>
	        		<div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Phone Number</label>		
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
		        			<input class="form-control" type="text" name="phone" value="{{ $servicedetail->phone }}">
		        			@if ($errors->has('phone'))
	        			 	<span class="help-block">
	        			     	<strong>{{ $errors->first('phone') }}</strong>
	        			    	</span>
	        				@endif
        				</div>
	        		</div>
	        		<div class="form-group {{ $errors->has('profile_image') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Profile Image</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
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
		        		<label class="col-sm-3 control-label">Gender</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
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
	        		</div>
	        		<div class="form-group {{ $errors->has('admin') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Admin</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
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
	        		</div>
	        		<div class="form-group {{ $errors->has('verified') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Verified Email</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
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
	        	</div>
	       		<!-- ************************************************************************************************ -->
	       		<!-- BAGIAN YANG SERVICE -->
	        	<div>
	          		<div class="form-group {{ $errors->has('main_service_id') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Main Service ID</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
		        			<input class="form-control" type="text" name="main_service_id" value="{{ $servicedetail->service->main_service_id }}">
	        				@if ($errors->has('main_service_id'))
	        			 	<span class="help-block">
	        			     	<strong>{{ $errors->first('main_service_id') }}</strong>
	        			    	</span>
	        				@endif	
	        			</div>   
	        		</div>
	          		<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Service ID</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
		        			<input class="form-control" type="text" name="service_id" value="{{ $servicedetail->service->id }}">
	        				@if ($errors->has('full_name'))
	        			 	<span class="help-block">
	        			     	<strong>{{ $errors->first('full_name') }}</strong>
	        			    	</span>
	        				@endif	   
	        			</div>
	        		</div>
	        		<div class="form-group {{ $errors->has('ktp_image') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">KTP Image</label>
	        			<div class="col-sm-7 col-sm-offset-1 form-style">
				            <input type="text" class="btn-up form-control" id="ktp_image_show{{ $servicedetail->id }}" name="ktp_image_show" placeholder="{{ $servicedetail->service->ktp_image }}" disabled>
			            	<label for="ktp_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
		                @if ($errors->has('ktp_image'))
        			 	<span class="help-block">
        			     	<strong>{{ $errors->first('ktp_image') }}</strong>
        			    	</span>
        				@endif
			                <input type="file" class="hidden" onchange="uploadOnChange1(this.id)" id="ktp_image{{ $servicedetail->id }}" name="ktp_image" accept=".jpeg, .png, .jpg">
		                </div>
	        		</div>
	        		<div class="form-group {{ $errors->has('sim_image') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">SIM Image</label>
	        			<div class="col-sm-7 col-sm-offset-1 form-style">
				            <input type="text" class="btn-up form-control" id="sim_image_show{{ $servicedetail->id }}" name="sim_image_show" placeholder="{{ $servicedetail->service->sim_image }}" disabled>
			            	<label for="sim_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
		                @if ($errors->has('sim_image'))
        			 	<span class="help-block">
        			     	<strong>{{ $errors->first('sim_image') }}</strong>
        			    	</span>
        				@endif
			                <input type="file" class="hidden" onchange="uploadOnChange2(this.id)" id="sim_image{{ $servicedetail->id }}" name="sim_image" accept=".jpeg, .png, .jpg">
		                </div>
	        		</div>
	        		<div class="form-group {{ $errors->has('stnk_image') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">STNK Image</label>
	        			<div class="col-sm-7 col-sm-offset-1 form-style">
				            <input type="text" class="btn-up form-control" id="stnk_image_show{{ $servicedetail->id }}" name="stnk_image_show" placeholder="{{ $servicedetail->service->stnk_image }}" disabled>
			            	<label for="stnk_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
		                @if ($errors->has('stnk_image'))
        			 	<span class="help-block">
        			     	<strong>{{ $errors->first('stnk_image') }}</strong>
        			    	</span>
        				@endif
			                <input type="file" class="hidden" onchange="uploadOnChange3(this.id)" id="stnk_image{{ $servicedetail->id }}" name="stnk_image" accept=".jpeg, .png, .jpg">
		                </div>
	        		</div>
	        		<div class="form-group {{ $errors->has('vehicle_image') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Vehicle Image</label>
	        			<div class="col-sm-7 col-sm-offset-1 form-style">
				            <input type="text" class="btn-up form-control" id="vehicle_image_show{{ $servicedetail->id }}" name="vehicle_image_show" placeholder="{{ $servicedetail->service->vehicle_image }}" disabled>
			            	<label for="vehicle_image{{ $servicedetail->id }}" class="btn-upload">Choose File</label>
		                @if ($errors->has('vehicle_image'))
        			 	<span class="help-block">
        			     	<strong>{{ $errors->first('vehicle_image') }}</strong>
        			    	</span>
        				@endif
			                <input type="file" class="hidden" onchange="uploadOnChange4(this.id)" id="vehicle_image{{ $servicedetail->id }}" name="vehicle_image" accept=".jpeg, .png, .jpg">
		                </div>
	        		</div>
	        		<div class="form-group {{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Vehicle Type</label>	
		        		<div class="col-sm-7 col-sm-offset-1 form-style			        		">
		        			<input class="form-control" type="text" name="vehicle_type" value="{{ $servicedetail->service->vehicle_type }}">
		        			@if ($errors->has('vehicle_type'))
	        			 	<span class="help-block">
	        			     	<strong>{{ $errors->first('vehicle_type') }}</strong>
	        			    	</span>
	        				@endif
        				</div>
	        		</div>
	        		<div class="form-group {{ $errors->has('license_platenumber') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">License Plate Number</label>				        
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
		        			<input class="form-control" type="text" name="license_platenumber" value="{{ $servicedetail->service->license_platenumber }}">
		        			@if ($errors->has('license_platenumber'))
	        			 	<span class="help-block">
	        			     	<strong>{{ $errors->first('license_platenumber') }}</strong>
	        			    	</span>
	        				@endif
	        			</div>
	        		</div>
	        		<div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label spasi">Category</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
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
	        		</div>
	        		<div class="form-group {{ $errors->has('verified_service') ? ' has-error' : '' }}">
		        		<label class="col-sm-3 control-label">Verified Service</label>
		        		<div class="col-sm-7 col-sm-offset-1 form-style">
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
			</form>
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')

@endsection