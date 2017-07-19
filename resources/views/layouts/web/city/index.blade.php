@extends('layouts/web/master_admin')
@section('pageTitle', 'View Provinces and City')
@section('content-subheader', 'List Provinces and City')
@section('main-content')
    @include ('flash::message')
	<table id="province" class="table table-bordred table-striped">
	    <thead>
           	<th>No</th>
           	<th>Province Name</th>
            <th>City Name</th>
        </thead>
    	<tbody>	
    		@foreach($cities as $city)
				<tr>
				    <td>{{ $city->id }}</td>
				    <td>{{ $city->name_city }}</td>
				    <td>{{ $city->province->name_province }}</td>
					<td>
						<p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit-{{ $city->id }}"><span class="glyphicon glyphicon-pencil"></span></button></p>
					</td>
				    <td>
				    	<p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $city->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
				    </td>
				    <td>
				</tr>

				<!-- Form edit -->
				<form action="{{ route('update-cities', ['id' => $city->id]) }}" id="update{{ $city->id }}" method="post" role="form">
				{{ csrf_field() }}
			   	{{ method_field('PATCH') }}
					<div class="modal fade" id="edit-{{ $city->id }}" role="dialog" aria-labelledby="edit" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
					    		<input class="form-control hidden" type="text" name="id" value="{{ $city->id }}" disabled>
					        	<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        		</button>
					        		<h4 class="modal-title custom_align" id="Heading">Edit Province</h4>
					      		</div>
					        	<div class="modal-body">
					        		<div class="form-group {{ $errors->has('name_city') ? ' has-error' : '' }}">
						        		<label>City Name</label>
					        			<input class="form-control" type="text" name="name_city" value="{{ $city->name_city }}">
				        				@if ($errors->has('name_city'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('name_city') }}</strong>
				        			    	</span>
				        				@endif	   
					        		</div>
					          		<div class="form-group {{ $errors->has('name_province') ? ' has-error' : '' }}">
						        		<label class="spasi">Province Name</label>
					        			<!-- <input class="form-control" type="text" name="name_province" value="{{ $city->province->name_province }}" disabled> -->
	        		        			<select id="province_id" name="province_id" class="form-control chosen-select mySelect" style="margin-left: 1%; width:50%;" placeholder="{{ $city->province->name_province }}" required>
	        		                	@foreach($provinces as $province)
	        		                     	<option value="{{ $province->id }}">{{ $province->name_province }}</option>
	        			                @endforeach
					                  	</select>

				        				@if ($errors->has('name_province'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('name_province') }}</strong>
				        			    	</span>
				        				@endif	   
					        		</div>
					      		</div>
					          	<div class="modal-footer ">
					        		<button type="submit" form="update{{ $city->id }}" class="btn btn-warning btn-lg btn-update"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
					      			<input type="hidden" name="action" value="update{{ $city->id }}" />
					      		</div>
					        </div>
					  	</div>    
					</div>
				</form>

				<!-- Form delete -->
	    		<form action="{{ route('delete-cities', ['id' => $city->id]) }}" id="delete{{ $city->id }}" method="post" role="form">
	    		    {{ csrf_field() }}
	    		    {{ method_field('DELETE') }}
	    		    <input type="text" class="hidden" name="id" value="{{ $city->id }}"/>
						<div class="modal fade" id="delete-{{ $city->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
							        	<button type="submit" class="btn btn-success" form="delete{{ $city->id }}">
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
	{{ $cities->links() }}

	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.mySelect').select2();
	});
</script>
@endsection