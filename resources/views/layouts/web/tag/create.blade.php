@extends('layouts/web/master_admin')
@section('pageTitle', 'New Tag')
@section('content-subheader', 'Create New Tag')
@section('main-content')
@include ('flash::message')
<div class="contentpanel cs_df">
	<div class="row">
   			<form action="{{ route('create-tags') }}" method="post" role="form">
		       	{{ csrf_field() }}
		       	
		       	<div class="form-group {{ $errors->has('keyword') ? ' has-error' : '' }}">
	                <label class="col-sm-3 control-label">Keyword <span class="asterisk">*</span></label>
	                <div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" class="form-control" name="keyword" placeholder="Your keyword.." required autofocus />
	                </div>
	                @if ($errors->has('keyword'))
	                	<span class="help-block"><strong>{{ $errors->first('keyword') }}</strong></span>
	                @endif
	            </div>

		       	<div class="col-sm-6 col-sm-offset-3">
			       	<button class="btn btn-info btn-block custom-btn">
			           Register
			       	</button>
			       	<input type="hidden" name="action" value="add" />
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