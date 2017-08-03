@extends('layouts/web/master_admin')
@section('pageTitle', 'Invite Friends, and Price Setting')
@section('content-subheader', 'Setting of Invite Friends and Price Setting')
@section('main-content')
	<div class="contentpanel cs_df">
	    @include ('flash::message')
		<div class="row">
				<div class="boxNone">
					<div class="textNone">Sorry you don't have data setting, please create one</div>
					<div class="col-sm-4 col-sm-offset-4">
				       	
				           <a href="{{ route('view-create-others') }}"><button class="btn btn-warning btn-lg btn-update">Create new setting</button></a>
				       	
			       	</div>
				</div>
		</div>
	</div>
@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	
</script>
@endsection