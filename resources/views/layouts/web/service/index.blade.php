@extends('layouts/web/master_admin')
@section('pageTitle', 'View Services Detail')
@section('content-subheader', 'List Services Detail')
@section('main-content')
    @include ('flash::message')
	 <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-provinces') }}"><span>  Add</span></a></div>
	<div id="service" class="rTable">
	    <div class="rTableHead">
           	<div class="rTableCell"><b>No</b></div>
            <div class="rTableCell"><b>Profile Image</b></div>
            <div class="rTableCell"><b>Full Name</b></div>
            <div class="rTableCell"><b>Email</b></div>
            <div class="rTableCell"><b>Gender</b></div>
            <div class="rTableCell"><b>Phone</b></div>
            <div class="rTableCell"><b>Category Service</b></div>
            <div class="rTableCell"><b>Verified</b></div>
            <div class="rTableCell"><b>Suspend</b></div>
            <div class="rTableCell"><b>Edit</b></div>
            <div class="rTableCell"><b>Delete</b></div>
            <div class="rTableCell"><b></b></div>
            <div class="rTableCell"></div>
        </div>
        	<?php $i = 1; $skipped = ($servicedetails->currentPage() * $servicedetails->perPage()) - $servicedetails->perPage(); ?>
	    	@foreach($servicedetails as $servicedetail)
	    	<div class="rTableBody">	
	    		<div class="rTableCell">{{ $skipped + $i }}</div>
	    		<div class="rTableCell"><img class="pp" src="{{ URL::asset('img/'.$servicedetail->profile_image) }}" alt="{{ $servicedetail->profile_image }}"/></div>
	    		<div class="rTableCell">{{ $servicedetail->full_name }}</div>
	    		<div class="rTableCell">{{ $servicedetail->email }}</div>
	    		@if ($servicedetail->gender == '0')
		    		<div class="rTableCell"><img src="{{ URL::asset('logo/female.png') }}" class="gender"/></div>
		    	@else 
		    		<div class="rTableCell"><img src="{{ URL::asset('logo/male.png') }}" class="gender"/></div>
		    	@endif
	    		<div class="rTableCell">{{ $servicedetail->phone }}</div>
			    <div class="rTableCell">{{ $servicedetail->service->category->category_type }}</div>
	    		@if ($servicedetail->verified == '1')
			    	<div class="rTableCell"><input type="checkbox" disabled checked/></div>
			    @else 
			    	<div class="rTableCell"><input type="checkbox" disabled/></div>
			    @endif
			    @if ($servicedetail->service->status == '0')
			    	<div class="rTableCell"><input type="checkbox" disabled checked/></div>
			    @else 
			    	<div class="rTableCell"><input type="checkbox" disabled/></div>
			    @endif
	    		<div class="rTableCell">
	    			<p><a href="{{ route('view-update-servicedetails', ['id' => $servicedetail->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>	
	    		</div>
	    		<div class="rTableCell">
	    			<form action="{{ route('delete-servicedetails', ['id' => $servicedetail->id]) }}" role="form" method="POST">
	    				{{ csrf_field() }}
	    				{{ method_field('DELETE') }}
		    			<p><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p>
		    		</form>
	    		</div>
	    		<div class="rTableCell">
	    			<p>
	    			@if($servicedetail->service->status == '0')
	    				<form action="{{ route('suspend-service', ['id' => $servicedetail->service->id]) }}" role="form" method="POST">
	    					{{ csrf_field() }}
	    					{{ method_field('PATCH') }}
	    					<input type="text" class="hidden" name="status" value="1" />
	    					<button clas="btn btn-info btn-xs"><span>Activate</span></button>
	    				</form>
	    			@else
	    				<form action="{{ route('suspend-service', ['id' => $servicedetail->service->id]) }}" role="form" method="POST">
	    					{{ csrf_field() }}
	    					{{ method_field('PATCH') }}
	    					<input type="text" class="hidden" name="status" value="0" />
	    					<button clas="btn btn-info btn-xs"><span>Suspend</span></button>
	    				</form>
	    			@endif
	    			</p>
	    		</div>
			@if($servicedetail->service->ktp_image != null)
		    <div class="rTableCell">
		    	<a href="{{ route('get-images', [ 'id' => $servicedetail->service->id, 'sim' => $servicedetail->service->sim_image, 'ktp' => $servicedetail->service->ktp_image, 'stnk' => $servicedetail->service->stnk_image, 'vehicle' => $servicedetail->service->vehicle_image ]) }}">View Detail Images</a>
		    </div>
		    @endif
		    </div>

			<!-- Form delete -->
			<!-- <div class="modal fade" id="delete{{ $servicedetail->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			    <div class="modal-dialog">
			    	<div class="modal-content">
			          	<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			        		<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
			      		</div>
				        <div class="modal-body">
				       		<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
				      	</div>
				        <div class="modal-footer ">
				        	<button type="button" class="btn btn-success" >
				        		<span class="glyphicon glyphicon-ok-sign"></span>Yes
				        	</button>
				        	<button type="button" class="btn btn-default" data-dismiss="modal">
				        		<span class="glyphicon glyphicon-remove"></span>No
				        	</button>
				      	</div>
			    	</div>
				</div>
			</div> -->
			<?php $i++; ?>
			@endforeach
		</div>

	<!-- Pagination -->
	{{ $servicedetails->links() }}

	@include('layouts.web.partials.footer')
	
@endsection

@section('script')
<script type="text/javascript">
	$('.mySelect').select2();

	window.addEventListener("load", function(event) {
    	// alert("All resources finished loading!");
  	});

  	function uploadOnChange(id)
	{
		idNew = id.substring(13); 
	    filename = document.getElementById('profile_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('profile_image_show'+idNew).value = filename;
		document.getElementById('profile_image_show'+idNew).innerHTML = filename;
	}

	function uploadOnChange1(id)
	{
		idNew = id.substring(9); 
	    filename = document.getElementById('ktp_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('ktp_image_show'+idNew).value = filename;
		document.getElementById('ktp_image_show'+idNew).innerHTML = filename;
	}

	function uploadOnChange2(id)
	{
		idNew = id.substring(9); 
	    filename = document.getElementById('sim_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('sim_image_show'+idNew).value = filename;
		document.getElementById('sim_image_show'+idNew).innerHTML = filename;
	}

	function uploadOnChange3(id)
	{
		idNew = id.substring(10); 
	    filename = document.getElementById('stnk_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('stnk_image_show'+idNew).value = filename;
		document.getElementById('stnk_image_show'+idNew).innerHTML = filename;
	}

	function uploadOnChange4(id)
	{
		idNew = id.substring(13); 
	    filename = document.getElementById('vehicle_image'+idNew).value;
	    lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
		document.getElementById('vehicle_image_show'+idNew).value = filename;
		document.getElementById('vehicle_image_show'+idNew).innerHTML = filename;
	}

	$('input[type="checkbox"]').click(function () {
    	$(this).prop("checked") ? $(this).val("1") : $(this).val("0");
	});
</script>
@endsection