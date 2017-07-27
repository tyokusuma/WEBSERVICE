@extends('layouts/web/master_admin')
@section('pageTitle', 'List Ads')
@section('content-subheader', 'List ads')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
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
			    <td><img src="{{ URL::asset('img/'.$ad->ads_image) }}" class="image-ads"/></td>
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
					<p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit-{{ $ad->id }}"><span class="glyphicon glyphicon-pencil"></span></button></p>
				</td>
			    <td>
			    	<p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $ad->id }}" ><span class="glyphicon glyphicon-trash"></span></button></p>
			    </td>
			</tr>

			<!-- Edit Form -->
				<form action="{{ route('update-ads', ['id' => $ad->id]) }}" method="patch" id="update{{ $ad->id }}">
	       		{{ csrf_field() }}
		       	{{ method_field('PATCH') }}
					<div class="modal fade" id="edit-{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
					    <div class="modal-dialog">
					    	<div class="modal-content">
						    	@if(Session::get('error_code'))
						    		<script>
						    		// alert('This is so annoying');
						    			$("#edit-5").modal('show');
						    		</script>
						    	@endif
					        	<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					        			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        		</button>
					        		<h4 class="modal-title custom_align" id="Heading">Choose this image as ads?</h4>
					      		</div>
					        	<div class="modal-body">
					        		<div class="image-modal">
							    		<img src="{{ URL::asset('img/'.$ad->ads_image) }}" class="image-ads-modal"/>			        			
					        		</div>
					        		<div class="form-group {{ $errors->has('choosen') ? ' has-error' : '' }}">
						        		<label>Choose</label>
					        			<span class="funkyradio">
					        				<input type="hidden" name="choosen" value="0">
					        					<div class="funkyradio-primary radio-inline">
				        			            	<input type="checkbox" name="choosen" id="choosen{{ $ad->id }}" value="1" <?php echo $ad->choosen == '1' ? 'checked' : '' ?>/>
				        			            	<label for="choosen{{ $ad->id }}">Choose this image</label>
				        			        	</div>
				        			    </span>
				        			    @if ($errors->has('choosen'))
				        			 	<span class="help-block">
				        			     	<strong>{{ $errors->first('choosen') }}</strong>
				        			    	</span>
				        				@endif
					        		</div>
					      		</div>
					          	<div class="modal-footer ">
					        		<button type="submit" form="update{{ $ad->id }}" class="btn btn-warning btn-lg btn-update"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
					      		</div>
					        </div>
					  	</div>    
					</div>
				</form>

				<!-- Delete Form -->
				<form action="{{ route('delete-ads', ['id' => $ad->id]) }}" id="delete{{ $ad->id }}" method="POST" role="form">
				{{ csrf_field() }}
    		    {{ method_field('DELETE') }}
						<div class="modal fade" id="delete-{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
							        	<button type="submit" class="btn btn-success" form="delete{{ $ad->id }}">
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
			<?php $i++; ?>
			@endforeach
		</tbody>
	</table>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	
</script>
@endsection