@extends('layouts/web/master_admin')
@section('pageTitle', 'Update ads')
@section('content-subheader', 'Choose this image as ads?')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('update-ads', ['id' => $ads->id]) }}" method="post" role="form" id="update{{ $ads->id }}">
	       	{{ csrf_field() }}
	       	{{ method_field('PATCH') }}
	       	<div class="form-group {{ $errors->has('choosen') ? ' has-error' : '' }}">
	       		<div class="ads-div">
		    		<img src="{{ URL::asset('img/'.$ads->ads_image) }}" class="image-ads"/>			      
        		</div>
        		<div class="ads-div">
    			<span class="funkyradio">
    				<input type="hidden" name="choosen" value="0">
    					<div class="funkyradio-primary radio-inline">
			            	<input type="checkbox" name="choosen" id="choosen{{ $ads->id }}" value="1" <?php echo $ads->choosen == '1' ? 'checked' : '' ?>/>
			            	<label for="choosen{{ $ads->id }}">Choose this image</label>
			        	</div>
			    </span>
			    @if ($errors->has('choosen'))
			 	<span class="help-block">
			     	<strong>{{ $errors->first('choosen') }}</strong>
			    	</span>
				@endif		                
                </div>
            </div>

	       	<div class="col-sm-6 col-sm-offset-3">
		       <button type="submit" form="update{{ $ads->id }}" class="btn btn-warning btn-lg btn-update">Yes</button>
	       	</div>
	   		</form>
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')

@endsection