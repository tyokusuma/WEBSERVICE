@extends('layouts/web/master_admin')
@section('pageTitle', 'View Payments')
@section('content-subheader', 'List Payments')
@section('main-content')
	@include ('flash::message')
	<table id="payment" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>User Name</th>
            <th>Code Payment</th>
            <th>Total Payment</th>
            <th>Paid to Bank</th>
            <th>Account Bank</th>
            <th>Apps Type</th>
            <th>Verified</th>
        </thead>
    	<tbody>	
    		<?php $i = 1; $skipped = ($payments->currentPage() * $payments->perPage()) - $payments->perPage(); ?>
    		@foreach($payments as $payment)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $payment->users->full_name }}</td>
				    <td>{{ $payment->code_payment }}</td>
				    <td>{{ 'Rp. '.number_format($payment->total_payment, 2) }}</td>
				    @if($payment->banks != null)
				    <td>
					    {{ $payment->banks->bank_name }}
				    </td>
				    <td>
					    {{ $payment->banks->bank_account }}
					</td>
					@else
					<td></td>
					<td></td>
					@endif
					<td>{{ $payment->apps_type }}</td>
		    		<!-- Verified payment or not -->
		    	    @if ($payment->payment_verified == '1')
		    	    	<td><input type="checkbox" disabled checked/></td>
		    	    @else 
		    	    	<td><input type="checkbox" disabled/></td>
		    	    @endif
					<td>
				    	<p><a href="{{ route('view-update-payments', ['id' => $payment->id]) }}"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
				    </td>
				    <td>
				</tr>
				<?php $i++; ?>		  
		    @endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $payments->links() }}

	@include('layouts.web.partials.footer')
@endsection