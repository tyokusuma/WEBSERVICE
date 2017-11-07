@extends('layouts/web/master_admin')
@section('pageTitle', 'New Bank')
@section('content-subheader', 'Create New Bank')
@section('main-content')
@include ('flash::message')
<div class="contentpanel cs_df">
	<div class="row">
   			<form action="{{ route('create-bank') }}" method="post" role="form" enctype="multipart/form-data">
		       	{{ csrf_field() }}
		       	
		       	<div class="form-group {{ $errors->has('bank_name') ? ' has-error' : '' }}">
	                <label class="col-sm-3 control-label">Bank Name <span class="asterisk">*</span></label>
	                <div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" class="form-control" name="bank_name" placeholder="Bank name" required/>
	                </div>
	            </div>

	            <div class="form-group {{ $errors->has('bank_account') ? ' has-error' : '' }}">
	                <label class="col-sm-3 control-label">Bank Account <span class="asterisk">*</span></label>
	                <div class="col-sm-7 col-sm-offset-1 form-style">
		        		<input type="text" class="form-control" name="bank_account" placeholder="Bank account" required/>
	                </div>
	            </div>

    	       	<div class="form-group {{ $errors->has('bank_image') ? ' has-error' : '' }}">
                    <label class="col-sm-3 control-label">Bank Logo <span class="asterisk">*</span></label>
                    <div class="col-sm-7 col-sm-offset-1 form-style">
    		            <input type="text" disabled="disabled" class="btn-up form-control" id="bank_image_show" name="bank_image_show" required>	
    	            	<label for="bank_image" class="btn-upload" >Choose File</label>	            	
    	                <input type="file" class="hidden" id="bank_image" name="bank_image" accept=".jpeg, .png, .jpg" onchange="uploadOnChange('bank_image')">
    	                @if ($errors->has('bank_image'))
    		               	<span class="help-block">
    		                   	<strong>{{ $errors->first('bank_image') }}</strong>
    		               	</span>
    		           	@endif		                
                    </div>
                </div>

                <div class="form-group {{ $errors->has('transfer_description') ? ' has-error' : '' }}">
	                <label class="col-sm-3 control-label">Transfer Description <span class="asterisk">*</span></label>
	                <div class="col-sm-7 col-sm-offset-1 form-style">
		        		<textarea class="form-control" name="transfer_description" placeholder="How to transfer..." required></textarea>
	                </div>
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