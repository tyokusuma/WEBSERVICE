@extends('layouts/web/master_admin')
@section('pageTitle', 'New Province')
@section('content-subheader', 'Create new province')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-provinces') }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	
	       	<div class="form-group {{ $errors->has('name_province') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Name Province <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="name_province" class="form-control" placeholder="Province Name" required/>
		           	@if ($errors->has('name_province'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('name_province') }}</strong>
		               	</span>
		           	@endif	        		
	        	</div>		           

			</div>	

	       	<div class="form-group {{ $errors->has('name_city') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Name City <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="name_city" class="form-control" placeholder="City Name" required/>
		           	@if ($errors->has('name_city'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('name_city') }}</strong>
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

@endsection