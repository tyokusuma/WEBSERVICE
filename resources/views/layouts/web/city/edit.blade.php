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
	       	<div class="form-group {{ $errors->has('province_id') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Type <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
	        		<select id="type" name="province_id" class="form-control chosen-select mySelect" required>
                     	<option value="" selected disabled hidden>{{ $city->province->name_province }}</option>
                     	@foreach($provinces as $province)
	                     	<option value="{{ $province->id }}">{{ $province->name_province }}</option>
                     	@endforeach
                  	</select>
	                @if ($errors->has('type'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('type') }}</strong>
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
		       	<button class="btn btn-warning btn-block custom-btn">
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