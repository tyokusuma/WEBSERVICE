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

				<!-- Form delete -->
	    		<form action="{{ route('delete-provinces', ['id' => $province->id]) }}" id="delete{{ $province->id }}" method="post" role="form">
	    		    {{ csrf_field() }}
	    		    {{ method_field('DELETE') }}
	    		    <input type="text" class="hidden" name="id" value="{{ $province->id }}"/>
						<div class="modal fade" id="delete-{{ $province->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
							        	<button type="submit" class="btn btn-success" form="delete{{ $province->id }}">
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
	<!-- Pagination -->
	{{ $provinces->links() }}

	@include('layouts.web.partials.footer')
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection