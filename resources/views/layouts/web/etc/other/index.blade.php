@extends('layouts/web/master_admin')
@section('pageTitle', 'Invite Friends, and Price Setting')
@section('content-subheader', 'Setting of Invite Friends and Price Setting')
@section('main-content')

<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
		<form action="{{ route('update-others', ['id' => $other->id]) }}" method="post" role="form" id="update-others">
       	{{ csrf_field() }}
       	{{ method_field('PATCH') }}
	       	<div class="form-group {{ $errors->has('invite_friends') ? ' has-error' : '' }}">
	            <label class="col-sm-3 control-label">Number of invited friends </label>
	            <div class="col-sm-7 col-sm-offset-1 form-style">
	                <input type="text" id="invite_friends" name="invite_friends" placeholder="{{ $other->invite_friends }}">
	                @if ($errors->has('invite_friends'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('invite_friends') }}</strong>
		               	</span>
		           	@endif		                
	            </div>
	        </div>
	        <div class="form-group {{ $errors->has('annual_price') ? ' has-error' : '' }}">
	            <label class="col-sm-3 control-label">Annual Price </label>
	            <div class="col-sm-7 col-sm-offset-1 form-style">
	                <input type="text" id="annual_price" name="annual_price" placeholder="{{ $other->annual_price }}">
	                @if ($errors->has('annual_price'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('annual_price') }}</strong>
		               	</span>
		           	@endif		                
	            </div>
	        </div>
	        <div class="form-group {{ $errors->has('selling_price') ? ' has-error' : '' }}">
	            <label class="col-sm-3 control-label">Selling Price </label>
	            <div class="col-sm-7 col-sm-offset-1 form-style">
	                <input type="text" id="selling_price" name="selling_price" placeholder="{{ $other->selling_price }}">
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