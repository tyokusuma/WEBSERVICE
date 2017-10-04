@extends('layouts/web/master_admin')
@section('pageTitle', 'Edit City')
@section('content-subheader', 'Edit city')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('update-cities', ['id' => $city->id]) }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	{{ method_field('PATCH') }}
	       	<div class="form-group {{ $errors->has('name_province') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Name Province <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
	        		<input type="text" name="name_province" class="form-control" placeholder="Province" value="{{ $city->name_province }}" required/>
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
	        		<input type="text" name="name_city" class="form-control" placeholder="City Name" value="{{ $city->name_city }}" required/>
		           	@if ($errors->has('name_city'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('name_city') }}</strong>
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
<script>
	$('.mySelect').select2();
</script>
@endsection