@extends('layouts/web/master_admin')
@section('pageTitle', 'View Armadas')
@section('content-subheader', 'List Armada')
@section('main-content')
    @include ('flash::message')
	<table id="armada" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>Armada Name</th>
            <th>ID Driver</th>
            <th>Driver Name</th>
            <th>Driver Vehicle Platenumber</th>
        </thead>
    	<tbody>	
    		@foreach($armadas as $armada)
				<tr>
				    <td>{{ $armada->id }}</td>
				    <td>{{ $armada->company_name }}</td>
				    <td>{{ $armada->id_driver }}</td>
				    <td>{{ $armada->driver_name }}</td>
				    <td>{{ $armada->vehicle_platenumber }}</td>
					<td>
						<p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit-{{ $armada->id }}"><span class="glyphicon glyphicon-pencil"></span></button></p>
					</td>
				    <td>
				    	<p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $armada->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
				    </td>
				    <td>
				</tr>
		  

				<!-- Form edit -->
				<form action="{{ route('update-armadas', ['id' => $armada->id]) }}" id="update{{ $armada->id }}" method="post" role="form">
				{{ csrf_field() }}
			   	{{ method_field('PATCH') }}
					<div class="modal fade" id="edit-{{ $armada->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
						    	@if($errors->has('driver_name'))
						    		<script>
						    		// alert('This is so annoying');
						    			$(function(){
                     						$('#edit-22').modal('show');
						                 });
						    		</script>
						    	@endif
					    		<input class="form-control hidden" type="text" name="id" value="{{ $armada->id }}" disabled>
					        	<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        		</button>
					        		<h4 class="modal-title custom_align" id="Heading">Edit Armada</h4>
					      		</div>
					        	<div class="modal-body">
					          		<div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
						        		<label>Armada Name</label>
					        			<input class="form-control" type="text" name="company_name" value="{{ $armada->company_name }}">
				        				@if ($errors->has('company_name'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('company_name') }}</strong>
				        			    	</span>
				        				@endif	   
					        		</div>
					        		<div class="form-group {{ $errors->has('id_driver') ? ' has-error' : '' }}">
						        		<label>ID Driver</label>
					        			<input class="form-control" type="text" name="id_driver" value="{{ $armada->id_driver }}">
				        				@if ($errors->has('id_driver'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('id_driver') }}</strong>
				        			    	</span>
				        				@endif	   
					        		</div>
					        		<div class="form-group {{ $errors->has('driver_name') ? ' has-error' : '' }}">
						        		<label>Driver Name</label>
					        			<input class="form-control" type="text" name="driver_name" value="{{ $armada->driver_name }}">
				        				@if ($errors->has('driver_name'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('driver_name') }}</strong>
				        			    	</span>
				        				@endif	   
					        		</div>
					        		<div class="form-group {{ $errors->has('vehicle_platenumber') ? ' has-error' : '' }}">
						        		<label>Vehicle Platenumber</label>
					        			<input class="form-control" type="text" name="vehicle_platenumber" value="{{ $armada->vehicle_platenumber }}">
				        				@if ($errors->has('vehicle_platenumber'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('vehicle_platenumber') }}</strong>
				        			    	</span>
				        				@endif	   
					        		</div>
					      		</div>
					          	<div class="modal-footer ">
					        		<button type="submit" form="update{{ $armada->id }}" class="btn btn-warning btn-lg btn-update"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
					      			<input type="hidden" name="action" value="update{{ $armada->id }}" />
					      		</div>
					        </div>
					  	</div>    
					</div>
				</form>

				<!-- Form delete -->
	    		<form action="{{ route('delete-armadas', ['id' => $armada->id]) }}" id="delete{{ $armada->id }}" method="post" role="form">
	    		    {{ csrf_field() }}
	    		    {{ method_field('DELETE') }}
	    		    <input type="text" class="hidden" name="id" value="{{ $armada->id }}"/>
						<div class="modal fade" id="delete-{{ $armada->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
							        	<button type="submit" class="btn btn-success" form="delete{{ $armada->id }}">
							        		<span class="glyphicon glyphicon-ok-sign"></span> Yes
							        	</button>
							        	<button type="button" class="btn btn-default" data-dismiss="modal">
							        		<span class="glyphicon glyphicon-remove"></span> No
							        	</button>
							      	</div>
						    	</div>
							</div>
						</div>
	    		</form>
    		@endforeach
	    </tbody>	        
	</table>
	<!-- Pagination -->
	{{ $armadas->links() }}

	@include('layouts.web.partials.footer')
@endsection