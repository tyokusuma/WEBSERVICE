@extends('layouts/web/master_admin')
@section('pageTitle', 'View Services')
@section('content-subheader', 'List Services')
@section('main-content')
	
	<table id="mainservice" class="table table-bordred table-striped">
	    <thead>
           	<th>ID</th>
            <th>Profile Image</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
        </thead>
    	<tbody>
    		<?php $i =1; $skipped = ($mainservices->currentPage() * $mainservices->perPage()) - $mainservices->perPage(); ?>
    		@foreach($mainservices as $mainservice)
		    	<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td><img src="{{ URL::asset('img/'.$mainservice->profile_image) }}" alt="{{ $mainservice->profile_image }}" style="width:64px; height:64px" /></td>
				    <td>{{ $mainservice->full_name }}</td>
				    <td>{{ $mainservice->email }}</td>
				    <td>{{ $mainservice->phone }}</td>

				    <!-- Gender -->
			    	@if ($mainservice->gender == '0')
			    		<td><img src="{{ URL::asset('logo/female.png') }}"/></td>
			    	@else 
			    		<td><img src="{{ URL::asset('logo/male.png') }}"/></td>
			    	@endif
				</tr>
				<?php $i++; ?>
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $mainservices->links() }}
	
	@include('layouts.web.partials.footer')

@endsection