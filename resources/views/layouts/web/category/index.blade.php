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
            <th>Tags</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($categories->currentPage() * $categories->perPage()) - $categories->perPage(); ?>
    		@foreach($categories as $category)
		    	<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $category->type }}</td>
				    <td>{{ $category->category_type }}</td>
				    <td>{{ $category->subcategory_type }}</td>
				    <td>{{ $category->tags }}</td>
					<td>
				    	<p><a href="{{ route('view-update-categories', ['id' => $category->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
				    </td>
				    <td>
				    	<form action="{{ route('delete-categories', ['id' => $category->id]) }}" role="form" method="POST">
				    		{{ csrf_field() }}
				    		{{ method_field('DELETE') }}
					    	<p><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p>
					    </form>
				    </td>
				</tr>

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