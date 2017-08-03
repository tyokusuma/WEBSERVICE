@extends('layouts/web/master_admin')
@section('pageTitle', 'List Ads')
@section('content-subheader', 'List ads')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<table id="ads" class="table table-bordred table-striped">
		<thead>
			<th>No</th>
			<th>Image</th>					
			<th>View</th>					
			<th>Show</th>					
			<th>Choosen Image</th>
			<th>Edit</th>
			<th>Delete</th>					
		</thead>
		<tbody>
			<?php $i = 1; $skipped = ($ads->currentPage() * $ads->perPage()) - $ads->perPage(); ?>
			@foreach($ads as $ad)
	    	<tr>
			    <td>{{ $skipped + $i }}</td>
			    <td><img src="{{ URL::asset('img/'.$ad->ads_image) }}" class="image-ads-modal"/></td>
			    <td>{{ $ad->click_count }}</td>
			    <td>{{ $ad->showing_count }}</td>
				<td>
					@if($ad->choosen == '1')
						<input type="checkbox" disabled checked>
					@else
						<input type="checkbox" disabled>
					@endif
				</td>
				<td>
					<a href="{{ route('view-update-ads', ['id' => $ad->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a>
				</td>
			    <td>
				    <a href="{{ route('delete-ads', ['id' => $ad->id]) }}"><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></a>
			    </td>
			</tr>

			<!-- Delete Form -->
			<form action="{{ route('delete-ads', ['id' => $ad->id]) }}" id="delete{{ $ad->id }}" method="POST" role="form">
       		{{ csrf_field() }}
	       	{{ method_field('DELETE') }}
				<!-- <div class="modal fade" id="delete-{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
				      			<input type="hidden" name="action" value="delete{{ $ad->id }}" />
					        	<button type="submit" class="btn btn-success" form="delete{{ $ad->id }}">
					        		<span class="glyphicon glyphicon-ok-sign"></span>  Yes
					        	</button>
					        	<button type="button" class="btn btn-default" data-dismiss="modal">
					        		<span class="glyphicon glyphicon-remove"></span>  No
					        	</button>
					      	</div>
				    	</div>
					</div>
				</div> -->
			</form>	
			<!--  -->
			<?php $i++; ?>
			@endforeach
		</tbody>
	</table>
</div>		
	<!-- Pagination -->
	{{ $ads->links() }}		    
@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	
</script>
@endsection