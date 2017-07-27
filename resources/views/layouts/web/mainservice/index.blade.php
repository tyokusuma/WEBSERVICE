@extends('layouts/web/master_admin')
@section('pageTitle', 'View Services')
@section('content-subheader', 'List Services')
@section('main-content')
	
	<table id="mainservice" class="table table-bordred table-striped">
	    <thead>
           	<th>ID</th>
            <th>Profile Image</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
        </thead>
    	<tbody>
    		<?php $i =1; $skipped = ($mainservices->currentPage() * $mainservices->perPage()) - $mainservices->perPage(); ?>
    		@foreach($mainservices as $mainservice)
		    	<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td><img src="{{ URL::asset('img/'.$mainservice->profile_image) }}" alt="{{ $mainservice->profile_image }}" style="width:64px; height:64px" /></td>
				    <td>{{ $mainservice->full_name }}</td>
				    <td>{{ $mainservice->email }}</td>
				    <td>{{ $mainservice->phone }}</td>

				    <!-- Gender -->
			    	@if ($mainservice->gender == '0')
			    		<td><img src="{{ URL::asset('logo/female.png') }}"/></td>
			    	@else 
			    		<td><img src="{{ URL::asset('logo/male.png') }}"/></td>
			    	@endif
				</tr>
				<?php $i++; ?>
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $mainservices->links() }}
	
	@include('layouts.web.partials.footer')

	<!-- Form edit -->
	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	    <div class="modal-dialog">
	    	<div class="modal-content">
	        	<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	        		</button>
	        		<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
	      		</div>
	        	<div class="modal-body">
	          		<div class="form-group">
	        			<input class="form-control " type="text" placeholder="Mohsin">
	        		</div>
		        	<div class="form-group">        
	        			<input class="form-control " type="text" placeholder="Irshad">
	        		</div>
	        		<div class="form-group">
	        			<textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>        
	        		</div>
	      		</div>
	          	<div class="modal-footer ">
	        		<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
	      		</div>
	        </div>
	  	</div>    
	</div>

	<!-- Form delete -->
	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
		        		<span class="glyphicon glyphicon-ok-sign"></span>.Yes
		        	</button>
		        	<button type="button" class="btn btn-default" data-dismiss="modal">
		        		<span class="glyphicon glyphicon-remove"></span>.No
		        	</button>
		      	</div>
	    	</div>
		</div>
	</div>
@endsection