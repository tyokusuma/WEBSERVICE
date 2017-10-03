@extends('layouts/web/master_admin')
@section('pageTitle', 'View Provinces')
@section('content-subheader', 'List Provinces')
@section('main-content')
    @include ('flash::message')
    <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-provinces') }}"><span>  Add</span></a></div>
	<table id="province" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>Province Name</th>
        </thead>
    	<tbody>
    		<?php $i = 1; $skipped = ($provinces->currentPage() * $provinces->perPage()) - $provinces->perPage(); ?>
    		@foreach($provinces as $province)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $province->name_province }}</td>
					<td>
						<p><a href="{{ route('view-update-provinces', ['id' => $province->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
					</td>
				    <td>
				    	<p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $province->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
				    </td>
				    <td>
				</tr>

	    		<?php $i++; ?>
    		@endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $provinces->links() }}

	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection