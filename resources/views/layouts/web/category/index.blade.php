@extends('layouts/web/master_admin')
@section('pageTitle', 'View Categories')
@section('content-subheader', 'List Categories')
@section('main-content')
    @include ('flash::message')
	<div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-categories') }}"><span>  Add</span></a></div>
	<table id="category" class="table table-bordred table-striped">
	    <thead>
           	<th>ID</th>
           	<th>Type</th>
            <th>Category Type</th>
            <th>Subcategory Type</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($categories->currentPage() * $categories->perPage()) - $categories->perPage(); ?>
    		@foreach($categories as $category)
		    	<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $category->type }}</td>
				    <td>{{ $category->category_type }}</td>
				    <td>{{ $category->subcategory_type }}</td>
				    
					<td>
				    	<p><a href="{{ route('view-update-categories', ['id' => $category->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
				    </td>
				    <td>
				    	<p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $category->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
				    </td>
				</tr>

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
  function edit_submit() {
    document.getElementById("update{{ $category->id }}").submit();
   }    
  </script>
@endsection