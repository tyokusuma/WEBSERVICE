@extends('layouts/web/master_admin')
@section('pageTitle', 'Edit Category')
@section('content-subheader', 'Edit category')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('update-categories', ['id' => $category->id]) }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	{{ method_field('PATCH') }}
	       	<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                <label class="col-sm-3 control-label">Type <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
	        		<!-- <input type="text" name="type" class="form-control" placeholder="Type"/> -->
	        		<select id="type" name="type" class="form-control chosen-select" required>
                     	<option value="" selected disabled hidden>{{ $category->type }}</option>
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
	        		<input type="text" name="category_type" class="form-control" placeholder="Category" value="{{ $category->category_type }}" required/>
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
	        		<input type="text" name="subcategory_type" class="form-control" placeholder="Subcategory" value="{{ $category->subcategory_type }}"/>
	                @if ($errors->has('subcategory_type'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('subcategory_type') }}</strong>
		               	</span>
		           	@endif
                </div>
            </div>

            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-warning btn-block custom-btn">
		           Update
		       	</button>
		       	<input type="hidden" name="action" value="update" />
	       	</div>
	   		</form>
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection