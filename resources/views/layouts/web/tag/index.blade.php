@extends('layouts/web/master_admin')
@section('pageTitle', 'View Tag')
@section('content-subheader', 'List Tag')
@section('main-content')
    @include ('flash::message')

	<div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-tags') }}"><span>  Add</span></a></div>
	<table id="tag" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
            <th>Keyword</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($tags->currentPage() * $tags->perPage()) - $tags->perPage(); ?>
    		@foreach($tags as $tag)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $tag->keyword }}</td>
					<td>
				    	<p><a href="{{ route('view-update-tags', ['id' => $tag->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
				    </td>
				    <td>
				    	@if(auth()->user()->admin == '2')
				    	<form action="{{ route('delete-tags', ['id' => $tag->id]) }}" method="POST" role="form">
			       		{{ csrf_field() }}
				       	{{ method_field('DELETE') }}
					    	<p><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p>
					    </form>
					    @endif
				    </td>
				    <td>
				</tr>
				<?php $i++; ?>		  
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $tags->links() }}

	@include('layouts.web.partials.footer')
@endsection