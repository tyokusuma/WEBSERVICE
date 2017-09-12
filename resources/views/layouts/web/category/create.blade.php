@extends('layouts/web/master_admin')
@section('pageTitle', 'New Category')
@section('content-subheader', 'Create new category')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-categories') }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	
	       	<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Type <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
	        		<!-- <input type="text" name="type" class="form-control" placeholder="Type"/> -->
	        		<select id="type" name="type" class="form-control chosen-select" required>
                     	<option value=""></option>
                     	<option value="kendaraan">Kendaraan</option>
	        		    <option value="pedagang">Pedagang</option>
                  	</select>

	                @if ($errors->has('type'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('type') }}</strong>
		               	</span>
		           	@endif
                </div>
            </div>
	       	<div class="form-group {{ $errors->has('category_type') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Category Type <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="category_type" class="form-control" placeholder="Category" required/>

	        		<!-- <select id="category_type" name="category_type" class="form-control chosen-select" autofocus>
                     	<option value=""></option>
                     	<option value="abang">Abang</option>
                     	<option value="bajaj">Bajaj</option>
                     	<option value="bemo">Bemo</option>
                     	<option value="bentor">Bentor</option>
                     	<option value="ojek">Ojek</option>
	        		    <option value="taxi">Taxi</option>
                  	</select> -->
		           	@if ($errors->has('category_type'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('category_type') }}</strong>
		               	</span>
		           	@endif	        		
	        	</div>		           

			</div>	

	       	<div class="form-group {{ $errors->has('subcategory_type') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Subcategory Type <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
	        		<input type="text" name="subcategory_type" class="form-control" placeholder="Subcategory"/>
	                @if ($errors->has('subcategory_type'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('subcategory_type') }}</strong>
		               	</span>
		           	@endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
            	<label class="col-sm-3 control-label">Tags <span class="asterisk">*</span></label>
            	<div class="col-sm-6 col-sm-offset-1 form-style">
            		<select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="You can insert multiple tags"/>
            			<option></option>
            			@forelse($tags as $tag)
	            			<option value="{{ $tag->keyword }}">{{ $tag->keyword }}</option>
            			@empty
    	        			<option></option>
            			@endforelse
            		</select>
            		@if($errors->has('tags'))
            			<span class="help-block">
	            			<strong>{{ $errors->first('tags') }}</strong>
            			</span>
            		@endif
            	</div>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-success btn-block custom-btn">
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
    $(".select2").select2();
</script>
@endsection