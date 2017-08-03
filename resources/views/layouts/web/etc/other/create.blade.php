@extends('layouts/web/master_admin')
@section('pageTitle', 'Invite Friends, and Price Setting')
@section('content-subheader', 'Setting of Invite Friends and Price Setting')
@section('main-content')

<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
		<form action="{{ route('create-others') }}" method="post" role="form" id="update-others">
       	{{ csrf_field() }}
	       	<div class="form-group {{ $errors->has('invite_friends') ? ' has-error' : '' }}">
	            <div class="col-sm-3 form-style">
		            <label class="control-label">Number of invited friends <span class="asterisk">*</span></label>
	            </div>
	            <div class="col-sm-7 col-sm-offset-1 form-style">
	                <input type="text" id="invite_friends" name="invite_friends" placeholder="Your setting for minimum invited friends" class="btn-up form-control">
	                @if ($errors->has('invite_friends'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('invite_friends') }}</strong>
		               	</span>
		           	@endif		                
	            </div>
	        </div>
	        <div class="form-group {{ $errors->has('annual_price') ? ' has-error' : '' }}">
	        	<div class="col-sm-3 form-style">
		            <label class="control-label">Annual Price <span class="asterisk">*</span></label>
	            </div>
	            <div class="col-sm-7 col-sm-offset-1 form-style">
	                <input type="text" id="annual_price" name="annual_price" placeholder="Your price for annual payment" class="btn-up form-control">
	                @if ($errors->has('annual_price'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('annual_price') }}</strong>
		               	</span>
		           	@endif		                
	            </div>
	        </div>
	        <div class="form-group {{ $errors->has('selling_price') ? ' has-error' : '' }}">
	        	<div class="col-sm-3 form-style">
		            <label class="control-label">Selling Price <span class="asterisk">*</span></label>
	            </div>
	            <div class="col-sm-7 col-sm-offset-1 form-style">
	                <input type="text" id="selling_price" name="selling_price" placeholder="Your price for selling price" class="btn-up form-control">
	                @if ($errors->has('selling_price'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('selling_price') }}</strong>
		               	</span>
		           	@endif		                
	            </div>
	        </div>
	       	<div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-warning btn-lg btn-update" form="update-others">
		           Update
		       	</button>
	       	</div>
   		</form>
	</div>
</div>		
@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	
</script>
@endsection