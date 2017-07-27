@extends('layouts/web/master_admin')
@section('pageTitle', 'View Categories')
@section('content-subheader', 'List Categories')
@section('main-content')
    @include ('flash::message')
	
	<table id="category" class="table table-bordred table-striped">
	    <thead>
           	<th>ID</th>
            <th>Category Type</th>
            <th>Subcategory Type</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($categories->currentPage() * $categories->perPage()) - $categories->perPage(); ?>
    		@foreach($categories as $category)
		    	<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $category->category_type }}</td>
				    <td>{{ $category->subcategory_type }}</td>
				    
					<td>
				    	<p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit-{{ $category->id }}" ><span class="glyphicon glyphicon-pencil"></span></button></p>
				    </td>
				    <td>
				    	<p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $category->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
				    </td>
				</tr>

				<!-- Edit Form -->
				<form action="{{ route('update-categories', ['id' => $category->id]) }}" id="update{{ $category->id }}" method="post" role="form">
	       		{{ csrf_field() }}
		       	{{ method_field('PATCH') }}
	       			<input type="text" class="hidden" name="id" value="{{ $category->id }}" disabled>
					<div class="modal fade" id="edit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
					    		<input class="form-control hidden" type="text" name="id" value="{{ $category->id }}" disabled>
					        	<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        		</button>
					        		<h4 class="modal-title custom_align" id="Heading">Edit Category</h4>
					      		</div>
					        	<div class="modal-body">
					          		<div class="form-group">
						        		<label>Category Type</label>
					        			<input class="form-control" type="text" name="category_type" value="{{ $category->category_type }}">					        		
					        		</div>
					        		<div class="form-group">
						        		<label>Subcategory Type</label>				        		
					        			<input class="form-control" type="text" name="subcategory_type" value="{{ $category->subcategory_type }}">					        		
					        		</div>						        	
					      		</div>
					          	<div class="modal-footer ">
					        		<button type="submit" form="update{{ $category->id }}" class="btn btn-warning btn-lg btn-update"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
					      			<input type="hidden" name="action" value="update{{ $category->id }}" />
					      		</div>
					        </div>
					  	</div>    
					</div>
				</form>

				<!-- Form delete -->
				<form action="{{ route('delete-categories', ['id' => $category->id]) }}" id="delete{{ $category->id }}" method="post" role="form">
	       		{{ csrf_field() }}
		       	{{ method_field('DELETE') }}
					<div class="modal fade" id="delete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
					          	<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					        		<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
					      		</div>
						        <div class="modal-body">
						       		<div class="alert alert-danger"> <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
						      	</div>
						        <div class="modal-footer ">
					      			<input type="hidden" name="action" value="delete{{ $category->id }}" />
						        	<button type="submit" class="btn btn-success" form="delete{{ $category->id }}">
						        		<span class="glyphicon glyphicon-ok-sign"></span>  Yes
						        	</button>
						        	<button type="button" class="btn btn-default" data-dismiss="modal">
						        		<span class="glyphicon glyphicon-remove"></span>  No
						        	</button>
						      	</div>
					    	</div>
						</div>
					</div>
				</form>
				<?php $i++; ?>
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $categories->links() }}
	
	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection