@extends('layouts/web/master_admin')
@section('pageTitle', 'View Armadas')
@section('content-subheader', 'List Armada')
@section('main-content')
    @include ('flash::message')
    <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-armadas') }}"><span>  Add</span></a></div>
	<table id="armada" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>Armada Name</th>
            <th>ID Driver</th>
            <th>Driver Name</th>
            <th>Driver Vehicle Platenumber</th>
        </thead>
    	<tbody>	
            <?php $i = 1; $skipped = ($armadas->currentPage() * $armadas->perPage()) - $armadas->perPage(); ?>
    		@foreach($armadas as $armada)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $armada->company_name }}</td>
				    <td>{{ $armada->id_driver }}</td>
				    <td>{{ $armada->driver_name }}</td>
				    <td>{{ $armada->vehicle_platenumber }}</td>
					<td>
						<p><a href="{{ route('view-update-armadas', ['id' => $armada->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
					</td>
				    <td>
				    	<p>
				    		<form action="{{ route('delete-armadas', ['id' => $armada->id]) }}" method="POST" role="form">
				    			{{ csrf_field() }}
				    			{{ method_field('DELETE') }}
				    			<button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
				    		</form>
				    	</p>
				    </td>
				    <td>
				</tr>

	    		<?php $i++; ?>
    		@endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $armadas->links() }}

	@include('layouts.web.partials.footer')
@endsection