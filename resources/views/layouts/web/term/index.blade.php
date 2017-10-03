@extends('layouts/web/master_admin')
@section('pageTitle', 'View Terms')
@section('content-subheader', 'List Terms')
@section('main-content')
    @include ('flash::message')
    <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-term') }}"><span>  Add</span></a></div>

	
	<table id="term" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>Type Term</th>
           	<th>Category Type Term</th>
            <th>Content</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($terms->currentPage() * $terms->perPage()) - $terms->perPage(); ?>
    		@foreach($terms as $term)
		    	<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $term->type_term }}</td>
				    <td>{{ $term->category_content }}</td>
				    <td><p><a href="{{ route('preview-term', ['id' => $term->id]) }}">Preview</a></p></td>
				    <td>
				    	<p><a href="{{ route('view-update-term', ['id' => $term->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
				    </td>
				    <td>
				    	<form role="form" method="POST" action="{{ route('delete-term', ['id' => $term->id]) }}">
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
	{{ $terms->links() }}

	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	
</script>
@endsection