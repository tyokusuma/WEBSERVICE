@extends('layouts/web/master_admin')
@section('pageTitle', 'New Message')
@section('content-subheader', 'Create new message')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-inbox') }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	
	       	<!-- User -->
	       	<div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">User Name <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<select id="user_id" name="user_id" class="form-control chosen-select mySelect" required>
	        			@foreach($users as $user)
	        			<option value="{{ $user->id }}">{{ $user->full_name }} <span>{{ $user->email }}</span></option>
	        			@endforeach
                  	</select>
		           	@if ($errors->has('user_id'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('user_id') }}</strong>
		               	</span>
		           	@endif	        		
	        	</div>		           

			</div>	

			<!-- Title -->
	       	<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Title <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
	        		<input type="title" name="title" class="form-control" placeholder="Title" required/>
	                @if ($errors->has('title'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('title') }}</strong>
		               	</span>
		           	@endif
                </div>
            </div>

            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-info btn-block custom-btn">
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
<script type="text/javascript">
	$('.mySelect').select2();
</script>
@endsection