@extends('layouts/web/master_admin')
@section('pageTitle', 'Invite Friends, and Price Setting')
@section('content-subheader', 'Setting of Invite Friends and Price Setting')
@section('main-content')

@include ('flash::message')

@if($other == null)
	<div class="contentpanel cs_df">
		<div class="row">
			<form action="{{ route('create-others') }}" method="post" role="form" id="create-others">
	       	{{ csrf_field() }}
		       	<div class="form-group {{ $errors->has('invite_friends') ? ' has-error' : '' }}">
		            <div class="col-sm-5 form-style">
			            <label class="control-label">Number of invited friends <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="invite_friends" name="invite_friends" placeholder="Your setting for minimum invited friends" class="btn-up form-control">
		                @if ($errors->has('invite_friends'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('invite_friends') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('trial_days') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Free days for trial <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="trial_days" name="trial_days" placeholder="How many days for trial active until expired" class="btn-up form-control">
		                @if ($errors->has('trial_days'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('trial_days') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('share_days') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Free days for invite friends method <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="share_days" name="share_days" placeholder="How many days for invite friends method active until expired" class="btn-up form-control">
		                @if ($errors->has('share_days'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('share_days') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('buying_days') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Free days for buying apps per year method <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="buying_days" name="buying_days" placeholder="How many days for buying user/service apps per year active until expired" class="btn-up form-control">
		                @if ($errors->has('buying_days'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('buying_days') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_year_user') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps user price per year <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_year_user" name="price_year_user" placeholder="How much the price for user apps per year" class="btn-up form-control">
		                @if ($errors->has('price_year_user'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_year_user') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_full_user') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps user full price <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_full_user" name="price_full_user" placeholder="How much the full price for user apps" class="btn-up form-control">
		                @if ($errors->has('price_full_user'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_full_user') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_year_service') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps service price per year <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_year_service" name="price_year_service" placeholder="How much the price for service apps per year" class="btn-up form-control">
		                @if ($errors->has('price_year_service'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_year_service') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_full_service') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps service full price <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_full_service" name="price_full_service" placeholder="How much the full price for service/provider apps" class="btn-up form-control">
		                @if ($errors->has('price_full_service'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_full_service') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		       	<div class="col-sm-6 col-sm-offset-3">
			       	<button class="btn btn-warning btn-lg btn-info" form="create-others">
			           Update
			       	</button>
		       	</div>
	   		</form>
		</div>
	</div>		
@else
	<div class="contentpanel cs_df">
		<div class="row">
			<form action="{{ route('update-others', ['id' => $other->id]) }}" method="post" role="form" id="update-others">
	       	{{ csrf_field() }}
	       	{{ method_field('PATCH') }}
		       	<div class="form-group {{ $errors->has('invite_friends') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Number of invited friends <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="invite_friends" name="invite_friends" value="{{ $other->invite_friends }}" class="btn-up form-control">
		                @if ($errors->has('invite_friends'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('invite_friends') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('trial_days') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Free days for trial <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="trial_days" name="trial_days" value="{{ $other->trial_days }}" class="btn-up form-control">
		                @if ($errors->has('trial_days'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('trial_days') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('share_days') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Free days for invite friends method <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="share_days" name="share_days" value="{{ $other->share_days }}" class="btn-up form-control">
		                @if ($errors->has('share_days'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('share_days') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('buying_days') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Free days for buying apps per year method <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="buying_days" name="buying_days" value="{{ $other->buying_days }}" class="btn-up form-control">
		                @if ($errors->has('buying_days'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('buying_days') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_year_user') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps user price per year <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_year_user" name="price_year_user" value="{{ 'Rp. '.number_format($other->price_year_user, 2) }}" class="btn-up form-control">
		                @if ($errors->has('price_year_user'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_year_user') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_full_user') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps user full price <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_full_user" name="price_full_user" value="{{ 'Rp. '.number_format($other->price_full_user, 2) }}" class="btn-up form-control">
		                @if ($errors->has('price_full_user'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_full_user') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_year_service') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps service price per year <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_year_service" name="price_year_service" value="{{ 'Rp. '.number_format($other->price_year_service, 2) }}" class="btn-up form-control">
		                @if ($errors->has('price_year_service'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_year_service') }}</strong>
			               	</span>
			           	@endif		                
		            </div>
		        </div>
		        <div class="form-group {{ $errors->has('price_full_service') ? ' has-error' : '' }}">
		        	<div class="col-sm-5 form-style">
			            <label class="control-label">Setting apps service full price <span class="asterisk">*</span></label>
		            </div>
		            <div class="col-sm-5 col-sm-offset-1 form-style">
		                <input type="text" id="price_full_service" name="price_full_service" value="{{ 'Rp. '.number_format($other->price_full_service, 2) }}" class="btn-up form-control">
		                @if ($errors->has('price_full_service'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('price_full_service') }}</strong>
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
@endif	
@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>

</script>
@endsection