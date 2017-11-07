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
    		<?php $i = 1; $skipped = ($favorites->currentPage() * $favorites->perPage()) - $favorites->perPage(); ?>
    		@foreach($favorites as $favorite)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $favorite->buyers->full_name }}</td>
				    <td>{{ $favorite->mainservices->full_name }}</td>
				    <td>{{ $favorite->category->category_type }}</td>
				    <td>{{ $favorite->category->subcategory_type }}</td>
				    <td>
				</tr>
				<?php $i++; ?>		  
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $favorites->links() }}

	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>

</script>
@endsection