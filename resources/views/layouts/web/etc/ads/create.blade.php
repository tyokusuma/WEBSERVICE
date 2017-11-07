@extends('layouts/web/master_admin')
@section('pageTitle', 'New Ads')
@section('content-subheader', 'Create new ads')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-ads') }}" method="post" role="form" enctype="multipart/form-data">
	       	{{ csrf_field() }}
	       	
	       	<div class="form-group {{ $errors->has('ads_image') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Profile Image <span class="asterisk">*</span></label>
                <div class="col-sm-7 col-sm-offset-1 form-style">
		            <input type="text" disabled="disabled" class="btn-up form-control" id="ads_image_show" name="ads_image_show" required>	
	            	<label for="ads_image" class="btn-upload" >Choose File</label>	            	
	                <input type="file" class="hidden" id="ads_image" name="ads_image" accept=".jpeg, .png, .jpg" onchange="uploadOnChange('ads_image')">
	                @if ($errors->has('ads_image'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('ads_image') }}</strong>
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
<script>
	function uploadOnChange(id) {
	    var filename = document.getElementById(id).value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById(id+'_show').value = filename;
	}
</script>
@endsection