@extends('layouts/web/master_admin')
@section('pageTitle', 'View Transactions')
@section('content-subheader', 'List Transactions')
@section('main-content')
	
	<table id="transaction" class="table table-bordred table-striped">
	    <thead>
           	<th>ID</th>
           	<th>Buyer Name</th>
            <th>Service Name</th>
            <th>Order Date</th>
            <th>Tracking</th>
        </thead>
    	<tbody>
    		<?php $i = 1; $skipped = ($transactions->currentPage() * $transactions->perPage()) - $transactions->perPage(); ?>
    		@foreach($transactions as $transaction)
				<tr>
				    <td>{{ $skipped + $i }}</td>
				    <td>{{ $transaction->mainservices->full_name }}</td>
				    <td>{{ $transaction->buyers->full_name }}</td>
				    <td>{{ $transaction->order_date }}</td>
				    <td>
				    	@if(strtolower($transaction->mainservices->service->category->type) == 'kendaraan' && ($transaction->status_order == 'pesanan diterima' || $transaction->status_order == 'perjalanan ke tempatmu'))
				    		@if($transaction->status_order == 'pesanan diterima' || $transaction->status_order == 'perjalanan ke tempatmu')
						    	<a href="{{ route('tracking-map', ['current_lat' => $transaction->mainservices->gps_latitude, 'current_lng' => $transaction->mainservices->gps_longitude, 'last_lat' => $transaction->buyers->gps_latitude, 'last_lng' => $transaction->buyers->gps_longitude]) }}"><p><button class="btn btn-warning btn-xs"><span class="fa fa-map-marker" aria-hidden="true"></span></button></p></a>
					    	@elseif($transaction->status_order == 'perjalanan ke tujuan bersama anda')
						    	<a href="{{ route('tracking-map', ['current_lat' => $transaction->mainservices->gps_latitude, 'current_lng' => $transaction->mainservices->gps_longitude, 'last_lat' => $transaction->latitude_destination, 'last_lng' => $transaction->longitude_destination]) }}"><p><button class="btn btn-warning btn-xs"><span class="fa fa-map-marker" aria-hidden="true"></span></button></p></a>
					    	@endif
				    	@endif
				    </td>
				    <td>
				</tr>
				<?php $i++; ?>
		    @endforeach
	    </tbody>	        
	</table>
	
	<!-- Pagination -->
	{{ $transactions->links() }}

	@include('layouts.web.partials.footer')

	<!-- Form edit -->
	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	    <div class="modal-dialog">
	    	<div class="modal-content">
	        	<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	        		</button>
	        		<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
	      		</div>
	        	<div class="modal-body">
	          		<div class="form-group">
	        			<input class="form-control " type="text" placeholder="Mohsin">
	        		</div>
		        	<div class="form-group">        
	        			<input class="form-control " type="text" placeholder="Irshad">
	        		</div>
	        		<div class="form-group">
	        			<textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>        
	        		</div>
	      		</div>
	          	<div class="modal-footer ">
	        		<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
	      		</div>
	        </div>
	  	</div>    
	</div>

	<!-- Form delete -->
	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	    <div class="modal-dialog">
	    	<div class="modal-content">
	          	<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        		<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
	      		</div>
		        <div class="modal-body">
		       		<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
		      	</div>
		        <div class="modal-footer ">
		        	<button type="button" class="btn btn-success" >
		        		<span class="glyphicon glyphicon-ok-sign"></span>.Yes
		        	</button>
		        	<button type="button" class="btn btn-default" data-dismiss="modal">
		        		<span class="glyphicon glyphicon-remove"></span>.No
		        	</button>
		      	</div>
	    	</div>
		</div>
	</div>
@endsection