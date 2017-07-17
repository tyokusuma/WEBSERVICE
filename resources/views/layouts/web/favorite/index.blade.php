@extends('layouts/web/master_admin')
@section('pageTitle', 'View Favorites')
@section('content-subheader', 'List Favorites')
@section('main-content')
	
	<table id="favorite" class="table table-bordred table-striped">
	    <thead>
           	<th>ID</th>
           	<th>Liked by user</th>
            <th>Service Name</th>
            <th>Category Type</th>
            <th>Subcategory Type</th>
        </thead>
    	<tbody>	
    		@foreach($favorites as $favorite)
				<tr>
				    <td>{{ $favorite->id }}</td>
				    <td>{{ $favorite->buyers->full_name }}</td>
				    <td>{{ $favorite->mainservices->full_name }}</td>
				    <td>{{ $favorite->category->category_type }}</td>
				    <td>{{ $favorite->category->subcategory_type }}</td>
					<td>
				    	<p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p>
				    </td>
				    <td>
				    	<p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p>
				    </td>
				    <td>
				</tr>
		  
				<!-- <button class="accordion">Section 1</button> -->
				<!-- <div class="panel">
				  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div> -->
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $favorites->links() }}

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