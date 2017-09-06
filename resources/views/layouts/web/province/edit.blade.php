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
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')

@endsection