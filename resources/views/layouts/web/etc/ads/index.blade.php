@extends('layouts/web/master_admin')
@section('pageTitle', 'List Ads')
@section('content-subheader', 'List ads')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
    <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-ads') }}"><span>  Add</span></a></div>
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
			    	<form action="{{ route('delete-ads', ['id' => $ad->id]) }}" method="POST" role="form">
			       		{{ csrf_field() }}
				       	{{ method_field('DELETE') }}
					    <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
			    	</form>
			    </td>
			</tr>

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