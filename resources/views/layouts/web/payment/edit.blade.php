@extends('layouts/web/master_admin')
@section('pageTitle', 'View Payment')
@section('content-subheader', 'Update Payment')
@section('main-content')
	<div class="contentpanel cs_df">
	    @include ('flash::message')
		<div class="row">
	   			<form action="{{ route('update-payments', ['id' => $payment->id, 'user_id' => $payment->users->id]) }}" method="post" role="form">
		       	{{ csrf_field() }}
		       	{{ method_field('PATCH') }}
		       	<div class="form-group">
	              	<label class="col-sm-3 control-label">Full Name </label>
	              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" class="form-control" value="{{ $payment->users->full_name }}" readonly/>
		        	</div>		           
				</div>	

		       	<div class="form-group">
	              	<label class="col-sm-3 control-label">Code Payment </label>
	              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" class="form-control" value="{{ $payment->code_payment }}" readonly/>
		        	</div>	          
				</div>

				<div class="form-group">
	              	<label class="col-sm-3 control-label">Apps Type </label>
	              	<div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" class="form-control" value="{{ $payment->apps_type }}" readonly/>
		        		<input name="apps_type" type="hidden" value="{{ $payment->apps_type }}"/>
		        	</div>	          
				</div>

	            <div class="form-group">
	                <label class="col-sm-3 control-label">Total Payment </label>
	                <div class="col-sm-6 col-sm-offset-1 form-style">
		        		<input type="text" class="form-control" value="{{ 'Rp. '.number_format($payment->total_payment, 2) }}" readonly/>
	                </div>	           	
	            </div>

		       	<div class="form-group {{ $errors->has('bank_id') ? ' has-error' : '' }}">
	                <label class="col-sm-3 control-label">Paid to Bank <span class="asterisk">*</span></label>
	                <div class="col-sm-6 col-sm-offset-1 form-style">
		        		<select name="bank_id">
		        			<option class="hidden" value="" selected>{!! $payment->banks == null ? '' : $payment->banks->bank_name !!}</option>
		        			@foreach($banks as $bank)
			        			<option value="{{$bank->id}}">{{ $bank->bank_name.' | '.$bank->bank_account }}</option>
			        		@endforeach
		        		</select>

		                @if ($errors->has('bank_id'))
			               	<span class="help-block">
			                   	<strong>{{ $errors->first('bank_id') }}</strong>
			               	</span>
			           	@endif
	                </div>
	            </div>

        		<div class="form-group {{ $errors->has('verified') ? ' has-error' : '' }}">
	        		<label class="col-sm-3 control-label">Verified Payment <span class="asterisk">*</span></label>
	                <div class="col-sm-6 col-sm-offset-1 form-style">
	        			<span class="funkyradio">
	    					<div class="funkyradio-info radio-inline">
	    						@if($payment->payment_verified == '1')
				            		<input type="checkbox" name="payment_verified" id="verified{{ $payment->id }}" value="1" checked/>
				            		<input id='Hidden' type='hidden' value='0' name='payment_verified'>
				            	@else
				            		<input type="checkbox" name="payment_verified" id="verified{{ $payment->id }}" value="0"/>		        			
				            		<input id='Hidden' type='hidden' value='1' name='payment_verified'>
				            	@endif
				            	<label for="verified{{ $payment->id }}">Verified</label>
				        	</div>					        				
	    			    </span>
	    			</div>
    			    @if ($errors->has('verified'))
    			 	<span class="help-block">
    			     	<strong>{{ $errors->first('verified') }}</strong>
    			    	</span>
    				@endif
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
	
</script>
@endsection