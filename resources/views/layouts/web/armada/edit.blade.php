@extends('layouts/web/master_admin')
@section('pageTitle', 'Edit Armada')
@section('content-subheader', 'Edit armada')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('update-armadas', ['id' => $armada->id]) }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	{{ method_field('PATCH') }}
	       	<div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Armada Name <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="company_name" class="form-control" placeholder="Armada Name" value="{{ $armada->company_name }}" required/>
		           	@if ($errors->has('company_name'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('company_name') }}</strong>
		               	</span>
		           	@endif	        		
	        	</div>		           

			</div>	

	       	<div class="form-group {{ $errors->has('id_driver') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">ID Driver <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="id_driver" class="form-control" placeholder="ID Driver" value="{{ $armada->id_driver }}" required/>
		           	@if ($errors->has('id_driver'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('id_driver') }}</strong>
		               	</span>
		           	@endif	        	
	        	</div>	          
			</div>

	       	<div class="form-group {{ $errors->has('driver_name') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Driver Name <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	           		<input type="text" name="driver_name" class="form-control" placeholder="Driver Name" value="{{ $armada->driver_name }}" required/>
		          	@if ($errors->has('driver_name'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('driver_name') }}</strong>
		               	</span>
		           	@endif
	           	</div>
	       	</div>

	       	<div class="form-group {{ $errors->has('vehicle_platenumber') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Vehicle Platenumber <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	           		<input type="text" name="vehicle_platenumber" class="form-control" placeholder="Vehicle Platenumber" value="{{ $armada->vehicle_platenumber }}" required/>
		          	@if ($errors->has('vehicle_platenumber'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('vehicle_platenumber') }}</strong>
		               	</span>
		           	@endif
	           	</div>
	       	</div>

            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-info btn-block custom-btn">
		           Update
		       	</button>
		       	<input type="hidden" name="action" value="update" />
	       	</div>
	   		</form>
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')

@endsection