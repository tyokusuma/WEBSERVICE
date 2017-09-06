@extends('layouts/web/master_admin')
@section('pageTitle', 'View Bank')
@section('content-subheader', 'List Bank')
@section('main-content')
    @include ('flash::message')

	<div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-bank') }}"><span>  Add</span></a></div>
	<table id="bank" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
            <th>Bank Name</th>
            <th>Bank Account</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($banks->currentPage() * $banks->perPage()) - $banks->perPage(); ?>
    		@foreach($banks as $bank)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $bank->bank_name }}</td>
				    <td>{{ $bank->bank_account }}</td>
				    <td><img src="{{ URL::asset('img/'.$bank->bank_image) }}" style="width: 100px;"/></td>
					<td>
				    	<p><a href="{{ route('view-update-bank', ['id' => $bank->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
				    </td>
				    <td>
				    	@if(auth()->user()->admin == '2')
				    	<form action="{{ route('delete-bank', ['id' => $bank->id]) }}" id="delete{{ $bank->id }}" method="POST" role="form">
			       		{{ csrf_field() }}
				       	{{ method_field('DELETE') }}
					    	<p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $bank->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
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
	{{ $banks->links() }}

	@include('layouts.web.partials.footer')
@endsection