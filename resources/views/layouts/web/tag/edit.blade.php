@extends('layouts/web/master_admin')
@section('pageTitle', 'View Tag')
@section('content-subheader', 'Update Tag')
@section('main-content')
    @include ('flash::message')
	<div class="contentpanel cs_df">
		<div class="row">
	   			<form action="{{ route('update-tags', ['id' => $tag->id]) }}" method="post" role="form">
			       	{{ csrf_field() }}
			       	{{ method_field('PATCH') }}
			       	<div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
		              	<label class="col-sm-3 control-label">Keyword </label>
		              	<div class="col-sm-7 col-sm-offset-1 form-style">
			        		<input type="text" class="form-control" name="keyword" value="{{ $tag->keyword }}" required/>

			        		@if($errors->has('keyword')) 
			        			<span class="help-block">{{ $errors->first('keyword') }}</span>
			        		@endif
			        	</div>		           
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