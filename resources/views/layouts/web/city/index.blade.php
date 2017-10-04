@extends('layouts/web/master_admin')
@section('pageTitle', 'View Provinces and City')
@section('content-subheader', 'List Provinces and City')
@section('main-content')
    @include ('flash::message')
    <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-cities') }}"><span>  Add</span></a></div>
	<table id="province" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>Province Name</th>
            <th>City Name</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($cities->currentPage() * $cities->perPage()) - $cities->perPage();?>
    		@foreach($cities as $city)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $city->name_province }}</td>
				    <td>{{ $city->name_city }}</td>
					<td>
						<p><a href="{{ route('view-update-cities', ['id' => $city->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
					</td>
				    <td>
				    	<form action="{{ route('delete-cities', ['id' => $city->id]) }}" id="delete{{ $city->id }}" method="post" role="form">
			    		    {{ csrf_field() }}
			    		    {{ method_field('DELETE') }}
					    	<p><button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></p>
					    </form>
				    </td>
				    <td>
				</tr>

	    		<?php $i++; ?>
    		@endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $cities->links() }}

	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection